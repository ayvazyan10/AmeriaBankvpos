<?php

namespace Ayvazyan10\AmeriaBankVPOS\Methods;

use Ayvazyan10\AmeriaBankVPOS\AmeriaBankVPOS;
use Exception;
use Illuminate\Support\Facades\Http;

class Pay extends AmeriaBankVPOS
{
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
            throw new Exception(self::PROVIDER . ' API error: ' . $e->getMessage());
        }

        $response = json_decode($client, true);

        if ($response['ResponseCode'] === 1) {
            redirect("https://services.ameriabank.am/VPOS/Payments/Pay?id={$response['PaymentID']}&lang={$language}")->send();
        } else {
            throw new Exception(self::PROVIDER . ' API error: ' . $response['ResponseMessage']);
        }
    }
}
