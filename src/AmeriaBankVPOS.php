<?php

namespace Ayvazyan10\AmeriaBankVPOS;

use Ayvazyan10\Models\AmeriaBankTransaction;
use Illuminate\Support\Facades\Http;
use Exception;

class AmeriaBankVPOS
{
    /**
     * @var string|mixed
     */
    public string $clientid;
    public string $username;
    public string $password;
    public string $backurl;
    public bool $testmode;
    public string $currency;
    public string $mode;

    public function __construct()
    {
        $this->clientid = config('ameriabank.ClientID');
        $this->username = config('ameriabank.Username');
        $this->password = config('ameriabank.Password');
        $this->backurl = route('order.payment.check');
        $this->testmode = config('ameriabank.TestMode');
        $this->currency = config('ameriabank.Currency');
        $this->mode = config('ameriabank.TestMode') ? 'test' : '';
    }

    /**
     * @param array $data
     * @return array
     */
    public function pay(array $data): array
    {
        $args = [
            "ClientID" => $this->clientid,
            "BackURL" => $this->backurl,
            "Username" => $this->username,
            "Password" => $this->password,
            "TestMode" => $this->testmode,
            "Currency" => $this->currency,
            "Amount" => $data["pay_amount"],
            "OrderID" => $data["order_id"],
            "Description" => $data["description"],
        ];

        try {
            $client = Http::post("https://services{$this->mode}.ameriabank.am/VPOS/api/VPOS/InitPayment", $args);
        } catch (Exception $e) {
            return dd($e->getMessage());
        }

        return json_decode($client, true);
    }

    /**
     * @param $request
     * @return mixed
     */
    public function check($request): mixed
    {
        $order_id = $request->input('orderID');
        $payment_id = $request->input('paymentID');

        if (empty($order_id)) {
            exit('Unexpected error, please contact to website support.');
        }

        $args = [
            "PaymentID" => $payment_id,
            "Username" => $this->username,
            "Password" => $this->password,
        ];

        $client = Http::post("https://services{$this->mode}.ameriabank.am/VPOS/api/VPOS/GetPaymentDetails", $args);

        $response = json_decode($client, true);

        $transaction = new AmeriaBankTransaction;
        $transaction->order_id = $response["OrderID"];
        $transaction->user_id = auth()->user()->id ? auth()->user()->id : null;
        $transaction->payment_id = $payment_id;
        $transaction->Provider = 'AMERIABANK';
        $transaction->fill($response)->save();

        return $response;
    }
}
