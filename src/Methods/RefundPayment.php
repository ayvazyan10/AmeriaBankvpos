<?php

namespace Ayvazyan10\AmeriaBankVPOS\Methods;

use Ayvazyan10\AmeriaBankVPOS\AmeriaBankVPOS;
use Exception;

class RefundPayment extends AmeriaBankVPOS
{
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
