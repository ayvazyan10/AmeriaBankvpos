<?php

namespace Ayvazyan10\AmeriaBankVPOS;

use Ayvazyan10\AmeriaBankVPOS\Model\AmeriaBankTransaction;
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
     * Send an HTTP request to the given URL with the provided arguments.
     *
     * @param string $url // URL to send the request to
     * @param array $parameters // Arguments to be sent in the request body
     * @return array // Response data as an associative array
     * @throws Exception // If any error occurs during the API request
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
     * Save the transaction details to the database.
     *
     * @param array $response // Response data from the API
     * @param string $payment_id // Payment ID received from the API
     * @return AmeriaBankTransaction // Saved transaction object
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
     * Cancel a specific payment.
     *
     * @param int|string $paymentId // Payment ID to be canceled
     * @return array // Array containing cancellation status and details
     * @throws Exception // If any error occurs during the API request
     */
    public function cancelPayment(int|string $paymentId): array
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
     * Check the payment status and return the transaction details.
     *
     * @param $request // Incoming request data
     * @return array // Array containing transaction status and details
     * @throws Exception // If any error occurs during the API request
     */
    public function check($request): array
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

        $transaction = $this->saveTransaction($response, $payment_id);

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
     * Get the details of a specific payment.
     *
     * @param int|string $paymentId The unique ID of the payment to retrieve details for.
     * @return array The details of the payment as an associative array.
     * @throws Exception If the payment ID does not exist or the HTTP request fails.
     */
    public function getPaymentDetails(int|string $paymentId): array
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
     * Process the payment and redirect to AMERIABANK payment interface.
     *
     * @param int|float $amount // Amount to Charge
     * @param int $orderId // Payment Unique Order ID
     * @param array $options // Additional information about payment with array[]
     * @throws Exception // If any error occurs during the API request
     */
    public function pay(int|float $amount, int $orderId, array $options = []): void
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
            redirect("https://services{$this->mode}.ameriabank.am/VPOS/Payments/Pay?id={$response['PaymentID']}&lang={$parameters["Language"]}")->send();
        } else {
            throw new Exception(self::PROVIDER . ' API error: ' . $response['ResponseMessage']);
        }
    }

    /**
     * Refund a specific payment partially.
     *
     * @param int|string $paymentId // Payment ID to be refunded
     * @param int|float $refundAmount // Refund amount
     * @return array // Array containing refund status and details
     * @throws Exception // If any error occurs during the API request
     */
    public function refund(int|string $paymentId, int|float $refundAmount): array
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
     * Making a binding payment request to AmeriaBank.
     *
     * @param int|float $amount // Amount to Charge
     * @param int $orderId // Payment Unique Order ID
     * @param array $options // Additional information about payment with array[]
     * @return array
     * @throws Exception // If any error occurs during the API request
     */
    public function makeBindingPayment(int|float $amount, int $orderId, array $options = []): array
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
     * Gets information about bindings from AmeriaBank VPOS API.
     *
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
     * Deactivate a binding with the given CardHolderID.
     *
     * @param string $cardHolderId The CardHolderID of the binding to deactivate
     * @throws Exception // If any error occurs during the API request
     */
    public function deactivateBinding(string $cardHolderId): array
    {
        $parameters = [
            "ClientID" => $this->clientId,
            "Username" => $this->username,
            "Password" => $this->password,
            "PaymentType" => 6,
        ];

        try {
            $client = Http::post("https://services{$this->mode}.ameriabank.am" . self::DEACTIVATE_BINDING_ENDPOINT, $parameters);
        } catch (Exception $e) {
            throw new Exception(self::PROVIDER . ' API error: ' . $e->getMessage());
        }

        return json_decode($client, true);
    }

    /**
     * Activate a binding with the given CardHolderID.
     * @param string $cardHolderId The CardHolderID of the binding to activate
     * @throws Exception // If any error occurs during the API request
     */
    public function activateBinding(string $cardHolderId): array
    {
        $parameters = [
            "ClientID" => $this->clientId,
            "Username" => $this->username,
            "Password" => $this->password,
            "PaymentType" => 6,
        ];

        try {
            $client = Http::post("https://services{$this->mode}.ameriabank.am" . self::ACTIVATE_BINDING_ENDPOINT, $parameters);
        } catch (Exception $e) {
            throw new Exception(self::PROVIDER . ' API error: ' . $e->getMessage());
        }

        return json_decode($client, true);
    }
}
