<?php

namespace Ayvazyan10\AmeriaBankVPOS;

use Ayvazyan10\Models\AmeriaBankTransaction;
use Illuminate\Support\Facades\Http;
use Exception;

abstract class AmeriaBankVPOS
{
    protected const PROVIDER = 'AMERIABANK';
    /**
     * @var string|mixed
     */
    protected string $clientId;
    protected string $username;
    protected string $password;
    protected string $backUrl;
    protected string $currency;
    protected string $mode;
    protected string $language;

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
     * Send an HTTP request to the given URL with the provided arguments.
     *
     * @param string $url // URL to send the request to
     * @param array $parameters // Arguments to be sent in the request body
     * @return array // Response data as an associative array
     * @throws Exception // If any error occurs during the API request
     */
    protected function sendRequest(string $url, array $parameters): array
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
    protected function saveTransaction(array $response, string $payment_id): AmeriaBankTransaction
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
