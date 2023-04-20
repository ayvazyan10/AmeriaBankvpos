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
        $this->clientid = config('ameriabankvpos.ClientID');
        $this->username = config('ameriabankvpos.Username');
        $this->password = config('ameriabankvpos.Password');
        $this->backurl = route(config('ameriabankvpos.BackUrl'));
        $this->testmode = config('ameriabankvpos.TestMode');
        $this->currency = config('ameriabankvpos.Currency');
        $this->mode = config('ameriabankvpos.TestMode') ? 'test' : '';
    }

    /**
     * @param array $data
     * @return array
     */
    public function pay(array $data): array
    {
        dd('ok');

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

        dd($data);

        try {
            $client = Http::post("https://services{$this->mode}.ameriabank.am/VPOS/api/VPOS/InitPayment", $args);
        } catch (Exception $e) {
            return dd($e->getMessage());
        }

        $pay = json_decode($client, true);

        if ($pay['ResponseCode'] === 1) {
            redirect("https://services.ameriabank.am/VPOS/Payments/Pay?id={$pay['PaymentID']}&lang={$data['user_language']}")->send();
        } else {
            redirect()->route('cart.checkout', ['locUtilale' => app()->getLocale()])->with(['order_complete_error' => $pay['ResponseMessage']]);
        }

        return json_decode($client, true);
    }

    /**
     * @param $request
     * @return mixed
     */
    public function check($request): mixed
    {
        dd($request);


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
