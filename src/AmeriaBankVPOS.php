<?php

namespace Ayvazyan10\AmeriaBankVPOS;

use Ayvazyan10\AmeriaBankVPOS\Model\AmeriaBankTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Exception;

class AmeriaBankVPOS implements AmeriaInterface
{
    private const PROVIDER = 'AMERIABANK';
    private const CANCEL_ENDPOINT = '/VPOS/api/VPOS/CancelPayment';
    private const GET_ENDPOINT = '/VPOS/api/VPOS/GetPaymentDetails';
    private const INIT_ENDPOINT = '/VPOS/api/VPOS/InitPayment';
    private const REFUND_ENDPOINT = '/VPOS/api/VPOS/RefundPayment';
    private const MAKE_BIND_ENDPOINT = '/VPOS/api/VPOS/MakeBindingPayment?';
    private const GET_BINDINGS_ENDPOINT = '/VPOS/api/VPOS/GetBindings';
    private const DEACTIVATE_BINDING_ENDPOINT = '/VPOS/api/VPOS/DeactivateBinding';
    private const ACTIVATE_BINDING_ENDPOINT = '/VPOS/api/VPOS/ActivateBinding';

    /**
     * @var string|mixed
     */
    protected string $clientId;
    protected string $username;
    protected string $password;
    protected string $backUrl;
    protected string $currency;
    protected string $mode;
    protected string $language;

    /**
     * AmeriaBankVPOS constructor.
     */
    public function __construct()
    {
        $this->clientId = config('ameriabankvpos.ClientID');
        $this->username = config('ameriabankvpos.Username');
        $this->password = config('ameriabankvpos.Password');
        $this->backUrl = route(config('ameriabankvpos.BackUrl'));
        $this->currency = config('ameriabankvpos.Currency');
        $this->language = config('ameriabankvpos.Language');
        $this->mode = config('ameriabankvpos.TestMode') === true ? 'test' : '';
    }

    /**
     * @param string $url
     * @param array $parameters
     * @return array
     * @throws Exception
     */
    final protected function sendRequest(string $url, array $parameters): array
    {
        try {
            $client = Http::post($url, $parameters);
        } catch (Exception $e) {
            throw new Exception(self::PROVIDER . ' API error: ' . $e->getMessage());
        }

        return json_decode($client->body(), true);
    }

    /**
     * @param array $response
     * @param string $payment_id
     * @return AmeriaBankTransaction
     */
    final protected function saveTransaction(array $response, string $payment_id): AmeriaBankTransaction
    {
        $transaction = new AmeriaBankTransaction;
        $transaction->order_id = $response["OrderID"];
        $transaction->user_id = optional(auth()->user())->id;
        $transaction->payment_id = $payment_id;
        $transaction->Provider = self::PROVIDER;
        $transaction->fill($response)->save();

        return $transaction;
    }

    /**
     * @param int|string $paymentId
     * @return array
     * @throws Exception
     */
    public function cancelPayment($paymentId): array
    {
        $parameters = [
            "PaymentID" => $paymentId,
            "Username" => $this->username,
            "Password" => $this->password,
        ];

        $response = $this->sendRequest("https://services{$this->mode}.ameriabank.am" . self::CANCEL_ENDPOINT, $parameters);

        if ($response["ResponseCode"] != '00') {
            return [
                "status" => "FAIL",
                "response" => $response
            ];
        }

        return [
            "status" => "SUCCESS",
            "response" => $response
        ];
    }

    /**
     * @param Request $request
     * @return array
     * @throws Exception
     */
    public function check(Request $request): array
    {
        $order_id = $request->input('orderID');
        $payment_id = $request->input('paymentID');

        if (empty($order_id)) {
            throw new Exception(self::PROVIDER . ' API error: Empty OrderID field');
        }

        $parameters = [
            "Username" => $this->username,
            "Password" => $this->password,
            "PaymentID" => $payment_id,
        ];

        $response = $this->sendRequest("https://services{$this->mode}.ameriabank.am" . self::GET_ENDPOINT, $parameters);

        $transaction = config('ameriabankvpos.StoreTransactions')
            ? $this->saveTransaction($response, $payment_id)
            : null;

        if ($response["ResponseCode"] != '00') {
            return [
                "status" => "FAIL",
                "transaction" => $transaction,
                "response" => $response
            ];
        }

        return [
            "status" => "SUCCESS",
            "transaction" => $transaction,
            "response" => $response
        ];
    }

    /**
     * @param int|string $paymentId
     * @return array
     * @throws Exception
     */
    public function getPaymentDetails($paymentId): array
    {
        $url = "https://services{$this->mode}.ameriabank.am" . self::GET_ENDPOINT;

        try {
            $response = Http::post($url, [
                'PaymentID' => $paymentId,
                'Username' => $this->username,
                'Password' => $this->password,
            ]);

            $responseData = json_decode($response, true);

            if (isset($responseData['Message'])) {
                throw new Exception('Payment ID not found or an error occurred: ' . $responseData['Message']);
            }

            return $responseData;
        } catch (\Illuminate\Http\Client\RequestException $e) {
            throw new Exception('AmeriaBank HTTP request error: ' . $e->getMessage());
        }
    }

    /**
     * @param int|float $amount
     * @param int $orderId
     * @param array $options
     * @return array
     * @throws Exception
     */
    public function pay($amount, int $orderId, array $options = []): array
    {
        $parameters = [
            "ClientID" => $this->clientId,
            "Username" => $this->username,
            "Password" => $this->password,
            "Amount" => $amount,
            "OrderID" => $orderId,
            "BackURL" => empty($options["BackURL"]) ? $this->backUrl : $options["BackURL"],
            "Language" => empty($options["Language"]) ? $this->language : $options["Language"],
            "Currency" => empty($options["Currency"]) ? $this->currency : $options["Currency"],
            "Description" => empty($options["Description"]) ? '' : $options["Description"],
            "Opaque" => empty($options["Opaque"]) ? ' ' : $options["Opaque"],
            "CardHolderID" => empty($options["CardHolderID"]) ? '' : $options["CardHolderID"],
        ];

        try {
            $client = Http::post("https://services{$this->mode}.ameriabank.am" . self::INIT_ENDPOINT, $parameters);
        } catch (Exception $e) {
            throw new Exception(self::PROVIDER . ' API error: ' . $e->getMessage());
        }

        $response = json_decode($client, true);

        if ($response['ResponseCode'] === 1) {
            $paymentId = $response['PaymentID'];
            $redirectUrl = "https://services{$this->mode}.ameriabank.am/VPOS/Payments/Pay?id={$paymentId}&lang={$parameters["Language"]}";

            return [
                "status" => "SUCCESS",
                "paymentId" => $paymentId,
                "redirectUrl" => $redirectUrl,
                "response" => $response
            ];
        }

        return [
            "status" => "FAIL",
            "response" => $response
        ];
    }

    /**
     * @param int|string $paymentId
     * @param int|float $refundAmount
     * @return array
     * @throws Exception
     */
    public function refund($paymentId, $refundAmount): array
    {
        $parameters = [
            "Username" => $this->username,
            "Password" => $this->password,
            "PaymentID" => $paymentId,
            "Amount" => $refundAmount
        ];

        $response = $this->sendRequest("https://services{$this->mode}.ameriabank.am" . self::REFUND_ENDPOINT, $parameters);

        if ($response["ResponseCode"] != '00') {
            return [
                "status" => "FAIL",
                "response" => $response
            ];
        }

        return [
            "status" => "SUCCESS",
            "response" => $response
        ];
    }

    /**
     * @param int|float $amount
     * @param int $orderId
     * @param array $options
     * @return array
     * @throws Exception
     */
    public function makeBindingPayment($amount, int $orderId, array $options = []): array
    {
        $parameters = [
            "ClientID" => $this->clientId,
            "Username" => $this->username,
            "Password" => $this->password,
            "Amount" => $amount,
            "OrderID" => $orderId,
            "PaymentType" => 6,
            "BackURL" => empty($options["BackURL"]) ? $this->backUrl : $options["BackURL"],
            "Language" => empty($options["Language"]) ? $this->language : $options["Language"],
            "Currency" => empty($options["Currency"]) ? $this->currency : $options["Currency"],
            "Description" => empty($options["Description"]) ? ' ' : $options["Description"],
            "Opaque" => empty($options["Opaque"]) ? ' ' : $options["Opaque"],
            "CardHolderID" => empty($options["CardHolderID"]) ? ' ' : $options["CardHolderID"],
        ];

        try {
            $client = Http::post("https://services{$this->mode}.ameriabank.am" . self::MAKE_BIND_ENDPOINT, $parameters);
        } catch (Exception $e) {
            throw new Exception(self::PROVIDER . ' API error: ' . $e->getMessage());
        }

        return json_decode($client, true);
    }

    /**
     * @return array
     * @throws Exception
     */
    public function getBindings(): array
    {
        $parameters = [
            "ClientID" => $this->clientId,
            "Username" => $this->username,
            "Password" => $this->password,
            "PaymentType" => 6,
        ];

        try {
            $client = Http::post("https://services{$this->mode}.ameriabank.am" . self::GET_BINDINGS_ENDPOINT, $parameters);
        } catch (Exception $e) {
            throw new Exception(self::PROVIDER . ' API error: ' . $e->getMessage());
        }

        return json_decode($client, true);
    }

    /**
     * @param string $cardHolderId
     * @return array
     * @throws Exception
     */
    public function deactivateBinding(string $cardHolderId): array
    {
        $parameters = [
            "ClientID" => $this->clientId,
            "Username" => $this->username,
            "Password" => $this->password,
            "PaymentType" => 6,
            "CardHolderID" => empty($cardHolderId) ? ' ' : $cardHolderId,
        ];

        try {
            $client = Http::post("https://services{$this->mode}.ameriabank.am" . self::DEACTIVATE_BINDING_ENDPOINT, $parameters);
        } catch (Exception $e) {
            throw new Exception(self::PROVIDER . ' API error: ' . $e->getMessage());
        }

        return json_decode($client, true);
    }

    /**
     * @param string $cardHolderId
     * @return array
     * @throws Exception
     */
    public function activateBinding(string $cardHolderId): array
    {
        $parameters = [
            "ClientID" => $this->clientId,
            "Username" => $this->username,
            "Password" => $this->password,
            "PaymentType" => 6,
            "CardHolderID" => empty($cardHolderId) ? ' ' : $cardHolderId,
        ];

        try {
            $client = Http::post("https://services{$this->mode}.ameriabank.am" . self::ACTIVATE_BINDING_ENDPOINT, $parameters);
        } catch (Exception $e) {
            throw new Exception(self::PROVIDER . ' API error: ' . $e->getMessage());
        }

        return json_decode($client, true);
    }
}
