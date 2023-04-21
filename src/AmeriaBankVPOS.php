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
    private bool $testMode;
    private string $currency;
    private string $mode;
    private string $language;

    public function __construct()
    {
        $this->clientId = config('ameriabankvpos.ClientID');
        $this->username = config('ameriabankvpos.Username');
        $this->password = config('ameriabankvpos.Password');
        $this->backUrl = route(config('ameriabankvpos.BackUrl'));
        $this->testMode = config('ameriabankvpos.TestMode');
        $this->currency = config('ameriabankvpos.Currency');
        $this->language = config('ameriabankvpos.Language');
        $this->mode = config('ameriabankvpos.TestMode') ? 'test' : '';
    }

    /**
     * @param int|float $amount // Amount to Charge
     * @param int $orderId // Payment Unique Order ID
     * @param string|null $description // Description for payment
     * @param string|null $language // Language to display on AMERIABANK payment interface
     * @return void // Redirecting or throwing Exception
     * @throws Exception
     */
    public function pay(int|float $amount, int $orderId, string $description = null, string $language = null): void
    {
        $args = [
            "ClientID" => $this->clientId,
            "BackURL" => $this->backUrl,
            "Username" => $this->username,
            "Password" => $this->password,
            "TestMode" => $this->testMode,
            "Currency" => $this->currency,
            "Amount" => $amount,
            "OrderID" => $orderId,
            "Description" => $description,
        ];

        try {
            $client = Http::post("https://services{$this->mode}.ameriabank.am/VPOS/api/VPOS/InitPayment", $args);
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
     * @param $request
     * @return string
     * @throws Exception
     */
    public function check($request): string
    {
        $order_id = $request->input('orderID');
        $payment_id = $request->input('paymentID');

        if (empty($order_id)) {
            throw new Exception(self::PROVIDER . ' API error: Empty OrderID field');
        }

        $args = [
            "PaymentID" => $payment_id,
            "Username" => $this->username,
            "Password" => $this->password,
        ];

        try {
            $client = Http::post("https://services{$this->mode}.ameriabank.am/VPOS/api/VPOS/GetPaymentDetails", $args);
        } catch (Exception $e) {
            throw new Exception(self::PROVIDER . ' API error: ' . $e->getMessage());
        }

        $response = json_decode($client, true);

        $transaction = new AmeriaBankTransaction;
        $transaction->order_id = $response["OrderID"];
        $transaction->user_id = auth()->user()->id ? auth()->user()->id : null;
        $transaction->payment_id = $payment_id;
        $transaction->Provider = self::PROVIDER;
        $transaction->fill($response)->save();

        if ($response["ResponseCode"] != '00') {
            return 'FAIL';
        }

        return 'SUCCESS';
    }
}
