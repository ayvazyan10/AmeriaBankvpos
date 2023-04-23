<?php

namespace Ayvazyan10\AmeriaBankVPOS\Methods;

use Ayvazyan10\AmeriaBankVPOS\AmeriaBankVPOS;
use Exception;

class CheckPayment extends AmeriaBankVPOS
{
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
}
