<?php

namespace Ayvazyan10\AmeriaBankVPOS\Methods;

use Ayvazyan10\AmeriaBankVPOS\AmeriaBankVPOS;
use Exception;

class AmeriaCancelPayment extends AmeriaBankVPOS
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
}
