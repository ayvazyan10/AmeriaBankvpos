<?php

namespace Ayvazyan10\AmeriaBankVPOS;

use Exception;
use Illuminate\Support\Facades\Http;

class AmeriaMethods
{
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

        $response = $this->sendRequest("https://services{$this->mode}.ameriabank.am/VPOS/api/VPOS/CancelPayment", $parameters);

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
            throw new Exception($this->PROVIDER . ' API error: Empty OrderID field');
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
     * Get the details of a specific payment.
     *
     * @param int|string $paymentId The unique ID of the payment to retrieve details for.
     * @return array The details of the payment as an associative array.
     * @throws Exception If the payment ID does not exist or the HTTP request fails.
     */
    public function getPaymentDetails(int|string $paymentId): array
    {
        $url = "https://services{$this->mode}.ameriabank.am/VPOS/api/VPOS/GetPaymentDetails";

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
     * @param string|null $description // Description for payment
     * @param string|null $currency // Currency to be used for the transaction
     * @param string|null $language // Language to display on AMERIABANK payment interface
     * @throws Exception // If any error occurs during the API request
     */
    public function pay(
        int|float $amount,
        int       $orderId,
        string    $description = null,
        string    $currency = null,
        string    $language = null
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
            throw new Exception($this->PROVIDER . ' API error: ' . $e->getMessage());
        }

        $response = json_decode($client, true);

        if ($response['ResponseCode'] === 1) {
            redirect("https://services.ameriabank.am/VPOS/Payments/Pay?id={$response['PaymentID']}&lang={$language}")->send();
        } else {
            throw new Exception($this->PROVIDER . ' API error: ' . $response['ResponseMessage']);
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
            "PaymentID" => $paymentId,
            "Username" => $this->username,
            "Password" => $this->password,
            "Amount" => $refundAmount
        ];

        $response = $this->sendRequest("https://services{$this->mode}.ameriabank.am/VPOS/api/VPOS/RefundPayment", $parameters);

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
}
