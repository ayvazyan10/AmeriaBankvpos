<?php

namespace Ayvazyan10\AmeriaBankVPOS;

use Ayvazyan10\Models\AmeriaBankTransaction;
use Illuminate\Support\Facades\Http;
use Exception;

class AmeriaBankVPOS
{
    private const PROVIDER = 'AMERIABANK';
    /**
     * @var string|mixed
     */
    private string $clientId;
    private string $username;
    private string $password;
    private string $backUrl;
    private string $currency;
    private string $mode;
    private string $language;

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
        $this->mode = config('ameriabankvpos.TestMode') ? 'test' : '';
    }

    /**
     * Process the payment and redirect to AMERIABANK payment interface.
     *
     * @param int|float $amount // Amount to Charge
     * @param int $orderId // Payment Unique Order ID
     * @param string|null $description // Description for payment
     * @param string|null $currency // Currency to be used for the transaction
     * @param string|null $language // Language to display on AMERIABANK payment interface
     * @throws Exception // If any error occurs during the API request
     */
    public function pay(
        int|float $amount,
        int $orderId,
        string $description = null,
        string $currency = null,
        string $language = null
    ): void
    {
        $parameters = [
            "ClientID" => $this->clientId,
            "BackURL" => $this->backUrl,
            "Username" => $this->username,
            "Password" => $this->password,
            "Language" => $language === null ? $this->language : $language,
            "Currency" => $currency === null ? $this->currency : $currency,
            "Amount" => $amount,
            "OrderID" => $orderId,
            "Description" => $description,
        ];

        try {
            $client = Http::post("https://services{$this->mode}.ameriabank.am/VPOS/api/VPOS/InitPayment", $parameters);
        } catch (Exception $e) {
            throw new Exception(self::PROVIDER . ' API error: ' . $e->getMessage());
        }

        $response = json_decode($client, true);

        if ($response['ResponseCode'] === 1) {
            redirect("https://services.ameriabank.am/VPOS/Payments/Pay?id={$response['PaymentID']}&lang={$language}")->send();
        } else {
            throw new Exception(self::PROVIDER . ' API error: ' . $response['ResponseMessage']);
        }
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
            "PaymentID" => $payment_id,
            "Username" => $this->username,
            "Password" => $this->password,
        ];

        $response = $this->sendRequest("https://services{$this->mode}.ameriabank.am/VPOS/api/VPOS/GetPaymentDetails", $parameters);

        $transaction = $this->saveTransaction($response, $payment_id);

        if ($response["ResponseCode"] != '00') {
            return [
                "status" => "FAIL",
                "transaction" => $transaction
            ];
        }

        return [
            "status" => "SUCCESS",
            "transaction" => $transaction
        ];
    }

    /**
     * Send an HTTP request to the given URL with the provided arguments.
     *
     * @param string $url // URL to send the request to
     * @param array $parameters // Arguments to be sent in the request body
     * @return array // Response data as an associative array
     * @throws Exception // If any error occurs during the API request
     */
    private function sendRequest(string $url, array $parameters): array
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
    private function saveTransaction(array $response, string $payment_id): AmeriaBankTransaction
    {
        $transaction = new AmeriaBankTransaction;
        $transaction->order_id = $response["OrderID"];
        $transaction->user_id = optional(auth()->user())->id;
        $transaction->payment_id = $payment_id;
        $transaction->Provider = self::PROVIDER;
        $transaction->fill($response)->save();

        return $transaction;
    }
}
