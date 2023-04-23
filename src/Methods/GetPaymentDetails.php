<?php

namespace Ayvazyan10\AmeriaBankVPOS\Methods;

use Ayvazyan10\AmeriaBankVPOS\AmeriaBankVPOS;
use Exception;
use Illuminate\Support\Facades\Http;

class GetPaymentDetails extends AmeriaBankVPOS
{
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
}
