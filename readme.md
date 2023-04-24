<h1 align="left">AmeriaBank VPOS Laravel Package</h1>
<p align="left">
  This package provides a simple and convenient integration with AmeriaBank VPOS for Laravel applications.
</p>

[![Buy me a coffee](https://img.shields.io/badge/Buy%20me%20a%20coffee-Donate-yellow?style=for-the-badge&logo=buymeacoffee)](https://www.buymeacoffee.com/ayvazyan403)

![Image Description](data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNDQiIGhlaWdodD0iNDYiIHZpZXdCb3g9IjAgMCAxNDQgNDYiPjxkZWZzPjxzdHlsZT4uYXtmaWxsOiNmZmZmZmY7fTwvc3R5bGU+PC9kZWZzPjxnIHRyYW5zZm9ybT0idHJhbnNsYXRlKDEwNTMgLTQyMykiPjxwYXRoIGNsYXNzPSJhIiBkPSJNLTEwMjEuNzI2LDQ0My4wNzRsLTUuNTg2LTE5LjI3N2gtNi41bC01LjU4OCwxOS4yNzctNS4yODMtMTkuMjc3SC0xMDUzbDguNzEsMjguMzY2aDguOTkzbDQuNzM3LTE1LjkxMiw0LjczNywxNS45MTJoOC45ODlsOC43MS0yOC4zNjZoLTguMzE5WiIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMCAwLjY1NSkiLz48cGF0aCBjbGFzcz0iYSIgZD0iTS0xMDEyLjYsNDIzLjQ4NmExNC43NTgsMTQuNzU4LDAsMCwwLTE0LjYxMSwxNC45QTE0Ljc1OSwxNC43NTksMCwwLDAtMTAxMi4zLDQ1M2ExNy4zMywxNy4zMywwLDAsMCwxMi4wNzktNC44ODhsLTQuMzcyLTMuOTcyYTEwLjAyOCwxMC4wMjgsMCwwLDEtNywyLjc0OSw3LjA4LDcuMDgsMCwwLDEtNy41My02LjUxNWgyMS4xMzR2LTIuMTM5Qy05OTcuOTksNDMwLjA2MS0xMDAzLjQyMSw0MjMuNDg0LTEwMTIuNiw0MjMuNDg2Wm0tNi40NiwxMi44OTFhNi43OTIsNi43OTIsMCwwLDEsNi42MzUtNi45MjNjLjIwOS0uMDA1LjQyMSwwLC42My4wMTNhNi40NzIsNi40NzIsMCwwLDEsNiw2LjkxWiIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMjAuOTMxIDAuMzk5KSIvPjxwYXRoIGNsYXNzPSJhIiBkPSJNLTk5Ni42NTcsNDIzLjc0NGwtMTAuNDc3LS4wMTF2MjguNDg1aDEwLjQ3N2MuMzIzLjAxMS42NDUuMDExLjk2NiwwQTE0LjI0NiwxNC4yNDYsMCwwLDAtOTgxLjkzNiw0MzcuNSwxNC4yNDcsMTQuMjQ3LDAsMCwwLTk5Ni42NTcsNDIzLjc0NFptLS4wNTMsMjYuODg5aC04LjY5MlY0MjUuMzA5aDguNjkyYy4xNDQsMCwuMjg2LDAsLjQzLDBhMTIuNjY1LDEyLjY2NSwwLDAsMSwxMi40NDcsMTIuODc3QTEyLjY2MywxMi42NjMsMCwwLDEtOTk2LjcwOSw0NTAuNjMzWiIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMzcuMjM3IDAuNjAyKSIvPjxwYXRoIGNsYXNzPSJhIiBkPSJNLTk3NS4wMTEsNDUzLjg2NmExNS40MzQsMTUuNDM0LDAsMCwwLDE1LjMzNS0xNS41MzFBMTUuNDMsMTUuNDMsMCwwLDAtOTc1LjEwOSw0MjNoLS4xYTE1LjQzNSwxNS40MzUsMCwwLDAtMTUuMzM0LDE1LjUzMUExNS40MzQsMTUuNDM0LDAsMCwwLTk3NS4wMTEsNDUzLjg2NlptLTkuNzA5LTI1LjE1NmExMy41NywxMy41NywwLDAsMSw5LjU2Ny0zLjk5NCwxMy41NzEsMTMuNTcxLDAsMCwxLDEzLjYyLDEzLjUyMiwxMy41NywxMy41NywwLDAsMS0xMy41MjMsMTMuNjE4LDEzLjU3MSwxMy41NzEsMCwwLDEtMTMuNjE4LTEzLjUyMkExMy41NjgsMTMuNTY4LDAsMCwxLTk4NC43MTksNDI4LjcxWiIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoNTAuNjc2IDApIi8+PHBhdGggY2xhc3M9ImEiIGQ9Ik0tMTAyOS4yMzIsNDUwLjg4NGwuOTY5LS4wMjh2LTZoLS45NjlaIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgxOS4zMzYgMTcuOTk5KSIvPjxwYXRoIGNsYXNzPSJhIiBkPSJNLTEwNDYuODcsNDQ5LjkxMWE5LjU4Niw5LjU4NiwwLDAsMS0xLjgxNS4xNzljLTEuMjgyLDAtMi40Ny0uMjc3LTIuNDctMi4yODEsMC0xLjkxNywxLjEwNi0yLjA3NSwyLjMzNC0yLjA3NWExMS4xNzQsMTEuMTc0LDAsMCwxLDEuOTUzLjE3OWwuMjE3LjA0LjA3OC0uOTUzLS4xODQtLjAyOWExNi40LDE2LjQsMCwwLDAtMi4xMjgtLjE4NGMtMS42LDAtMy4yMzIuMzU5LTMuMjMsMy4wNDR2MGMwLDIuMTU3LDEuMDg4LDMuMiwzLjMxOCwzLjJhMTQuNzE2LDE0LjcxNiwwLDAsMCwyLjA0NC0uMTg2bC4xODItLjAyOS0uMDc4LS45NTNaIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgwLjcyNyAxNy45MzgpIi8+PHBhdGggY2xhc3M9ImEiIGQ9Ik0tMTAzNy40MSw0NDUuOGwuMDgxLS45MzdoLTUuMTI3djYuMDE4bDUuMDM3LS4wMTcuMDc5LS45NDdoLTQuMTV2LTEuNTg2aDMuNjIxbC4wNTMtLjk0N2gtMy42NzRWNDQ1LjhaIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSg4LjY2NiAxNy45OTkpIi8+PHBhdGggY2xhc3M9ImEiIGQ9Ik0tMTAyMy42Nyw0NDkuNTA5bC0yLjM3OC00LjY1N2gtMS4wOTFsMy4xLDYuMDE3aC43MDlsMy4wODgtNmgtMS4wODJaIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgyMS4wMyAxNy45OTIpIi8+PHBhdGggY2xhc3M9ImEiIGQ9Ik0tMTA0My40NzQsNDQ4Ljc1NGMxLjA1MSwwLDEuNjgtLjczMiwxLjY4LTEuOTU3cy0uNjI4LTEuOTM3LTEuNjgzLTEuOTM3aC0zLjgxNXY2LjAxOGguOTY5di0yLjExMmgxLjUwN2wxLjkwNywyLjExMmgxLjI1NWwtMS45MDktMi4xMjJabS43MDctMS45NThjMCwuNjM5LS4yNjYsMS4wMjItLjcxMSwxLjAyMmgtMi44NTV2LTIuMDFsMi44NTUtLjAwOUMtMTA0My4wMTgsNDQ1LjgtMTA0Mi43NjYsNDQ2LjE1My0xMDQyLjc2Niw0NDYuOFoiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDQuNjkxIDE3Ljk5OSkiLz48cGF0aCBjbGFzcz0iYSIgZD0iTS0xMDMzLjk4Nyw0NDUuOGgyLjQxMXY1LjA2M2guOTY5VjQ0NS44aDIuMjc2bC4wNzktLjk0N2gtNS43MzRaIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgxNS40NjMgMTcuOTk1KSIvPjxwYXRoIGNsYXNzPSJhIiBkPSJNLTEwMzUuMzM2LDQ0NC44NjFsLTMuMDc5LDZoMS4wNmwuNjY1LTEuMjk0aDMuNGwuNzIsMS40MTQuMTQ4LS4xMjRoLjg4NWwtMy4wNy02Wm0xLjYsMy44aC0yLjVsMS4yNTMtMi40NTRaIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgxMS44NiAxNy45OTkpIi8+PHBhdGggY2xhc3M9ImEiIGQ9Ik0tOTkwLjUxOSw0NTAuODg3bC45NjktLjA0MnYtNS45ODNoLS45NjlaIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSg1MC44MzEgMTgpIi8+PHBhdGggY2xhc3M9ImEiIGQ9Ik0tOTg1LDQ0NC43OTFoLS4wMThhMy4xMTcsMy4xMTcsMCwwLDAtMy4xLDMuMDcyLDIuNzQzLDIuNzQzLDAsMCwwLC41LDIuMDU1LDIuNzQxLDIuNzQxLDAsMCwwLDEuODA5LDEuMSwyLjcyMSwyLjcyMSwwLDAsMCwuNDIzLjAzMywyLjY1LDIuNjUsMCwwLDAsLjQtLjAyOSwzLjEsMy4xLDAsMCwwLDIuMi0uOTI1LDMuMDkyLDMuMDkyLDAsMCwwLC45LTIuMjA2LDMuMSwzLjEsMCwwLDAtLjkyNS0yLjJBMy4wOTIsMy4wOTIsMCwwLDAtOTg1LDQ0NC43OTFabTIuMTczLDMuMTYxYTEuODQ2LDEuODQ2LDAsMCwxLS4zMzksMS4zOTIsMS44NTQsMS44NTQsMCwwLDEtMS4yMjMuNzQ1LDEuODQ1LDEuODQ1LDAsMCwxLS41NjcsMGwtLjAyOSwwLS4wMjksMGExLjg3OSwxLjg3OSwwLDAsMS0xLjQtLjM2MywxLjg4MiwxLjg4MiwwLDAsMS0uNzM4LTEuMjUsMS45NzQsMS45NzQsMCwwLDEsMC0uNTc2YzAtMS41LjY2LTIuMTY4LDIuMTY4LTIuMTdhMS45MTgsMS45MTgsMCwwLDEsMi4xNjEsMS42MzEsMi4xMjQsMi4xMjQsMCwwLDEsLjAxNS4zNTdoLS4wNTNaIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSg1Mi42NDEgMTcuOTQyKSIvPjxwYXRoIGNsYXNzPSJhIiBkPSJNLTk5NS4yNzQsNDQ1LjhoMi40MTF2NS4wNjZsLjk2OS0uMDE1VjQ0NS44aDIuMjYzbC4wNzktLjk0N2gtNS43MjJaIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSg0Ni45NDYgMTcuOTk2KSIvPjxwYXRoIGNsYXNzPSJhIiBkPSJNLTk3OC4yLDQ0OS4yMTVsLTMuODUyLTQuMjktLjA2MS0uMDY2aC0uNzUzdjYuMDE3aC45Njl2LTQuMzYybDMuOTI4LDQuMzU2Ljc0Ni0uMDJ2LTUuOTg3aC0uOTc4WiIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoNTYuOTgxIDE3Ljk5OCkiLz48cGF0aCBjbGFzcz0iYSIgZD0iTS05NzUuMyw0NDcuNDRjLTEuMi0uMTg4LTEuNjI3LS4zLTEuNjI3LS44NzUsMC0uNjA3LjQ0OC0uODMzLDEuNjUyLS44MzNhMTIuNjExLDEyLjYxMSwwLDAsMSwyLjEwNi4xNzlsLjIxNy4wMzguMDY5LS45NTMtLjE4NC0uMDI3YTE3Ljc1NCwxNy43NTQsMCwwLDAtMi4yMTUtLjE4NGMtLjY0MywwLTIuNiwwLTIuNiwxLjc1OCwwLDEuMzk0LDEuMjMyLDEuNjA5LDIuNTM0LDEuODM2bC4xOC4wMzFjMS4wMjYuMTczLDEuNTYxLjI4OCwxLjU2MS44NTFzLS41My44MjMtMS44LjgyNWwtLjAyMiwwaDBhMTQuNTkzLDE0LjU5MywwLDAsMS0yLjI4NS0uMThsLS4yMTktLjAzMy0uMDU1Ljk1MS4xODQuMDI2YTIwLjI2OSwyMC4yNjksMCwwLDAsMi40NzIuMTg0YzEuNzcxLDAsMi42NjctLjU5MiwyLjY2Ny0xLjc1OEMtOTcyLjY2Myw0NDcuOS05NzMuOTQyLDQ0Ny42NzktOTc1LjMsNDQ3LjQ0WiIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoNjAuOTk1IDE3LjkzOCkiLz48cGF0aCBjbGFzcz0iYSIgZD0iTS0xMDAzLjQ4Myw0NDQuODYxaC0uOTgxdjYuMDE3aDUuMDM5bC4wNTUtLjY1Ni4zLS4zaC00LjQxNloiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDM5LjQ3MyAxNy45OTkpIi8+PHBhdGggY2xhc3M9ImEiIGQ9Ik0tMTAxMS41ODMsNDQ3LjQ0NWMtMS4yMDYtLjE4OC0xLjYyNy0uMy0xLjYyNy0uODc0LDAtLjYwNy40NDgtLjgzMywxLjY1Mi0uODMzYTEyLjUzLDEyLjUzLDAsMCwxLDIuMTA2LjE3OWwuMjE3LjAzOC4wNjktLjk1My0uMTg0LS4wMjdhMTcuNzY2LDE3Ljc2NiwwLDAsMC0yLjIxNS0uMTg0Yy0uNjQzLDAtMi42LDAtMi42LDEuNzU4LDAsMS4zOTQsMS4yMzIsMS42MDksMi41MzYsMS44MzZsLjE3Ny4wMzFjMS4wMjguMTcxLDEuNTYzLjI4OCwxLjU2My44NTFzLS41My44MjMtMS44LjgyNWwtLjAyNiwwaC0uMDA1YTE0LjcwOSwxNC43MDksMCwwLDEtMi4yODUtLjE3OWwtLjIxOS0uMDM2LS4wNTUuOTUzLjE4NC4wMjZhMjAuMjcxLDIwLjI3MSwwLDAsMCwyLjQ3Mi4xODRjMS43NzEsMCwyLjY2Ny0uNTkyLDIuNjY3LTEuNzU4Qy0xMDA4Ljk0Nyw0NDcuOTA4LTEwMTAuMjI1LDQ0Ny42ODQtMTAxMS41ODMsNDQ3LjQ0NVoiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDMxLjQ5OCAxNy45NDIpIi8+PHBhdGggY2xhc3M9ImEiIGQ9Ik0tOTk1LjMsNDQ4LjUxOWMwLDEuMzc1LTEuMywxLjUyMy0xLjg2MiwxLjUyM3MtMS44NzgtLjE0OC0xLjg3OC0xLjUyM3YtMy42NjJoLS45Njl2My42NjJjMCwxLjU0MSwxLjA2NCwyLjQ2MSwyLjg0OCwyLjQ2MXMyLjgyMi0uOSwyLjgyMi0yLjQ2MXYtMy42NjJoLS45NloiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDQzLjA5OSAxNy45OTYpIi8+PHBhdGggY2xhc3M9ImEiIGQ9Ik0tMTAwNi42LDQ0NC44aC0uMDE2YTMuMTE5LDMuMTE5LDAsMCwwLTMuMSwzLjA3LDIuNzU5LDIuNzU5LDAsMCwwLC41LDIuMDU5LDIuNzUzLDIuNzUzLDAsMCwwLDEuODA5LDEuMSwyLjY4NywyLjY4NywwLDAsMCwuNDIxLjAzMSwyLjY3MiwyLjY3MiwwLDAsMCwuNC0uMDI3LDMuMDkzLDMuMDkzLDAsMCwwLDIuMi0uOTI1LDMuMSwzLjEsMCwwLDAsLjktMi4yMDYsMy4xLDMuMSwwLDAsMC0uOTI0LTIuMkEzLjEsMy4xLDAsMCwwLTEwMDYuNiw0NDQuOFptMi4xNzQsMy4xNjFhMS44NTksMS44NTksMCwwLDEtLjMzOSwxLjM5MiwxLjg1OCwxLjg1OCwwLDAsMS0xLjIyNC43NDUsMS44MzUsMS44MzUsMCwwLDEtLjU2NSwwbC0uMDI3LDAtLjAyOSwwYTEuOSwxLjksMCwwLDEtMi4xNDQtMS42MTIsMi4wMzUsMi4wMzUsMCwwLDEsMC0uNTc2YzAtMS41LjY2MS0yLjE2OCwyLjE2OC0yLjE3YTEuOSwxLjksMCwwLDEsMS40MTcuMzcsMS45LDEuOSwwLDAsMSwuNzQsMS4yNjMsMS45NzMsMS45NzMsMCwwLDEsMCwuNTI4bDAsLjAyOVoiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDM1LjE3NyAxNy45NDYpIi8+PHBhdGggY2xhc3M9ImEiIGQ9Ik0tMTAyMC44MjIsNDQ4LjMzNGgzLjYyMWwuMDUzLS45NDdoLTMuNjc5VjQ0NS44aDQuMDczbC4wNzktLjk0N2gtNS4xMTV2Ni4wMThsNS4wMzktLjAwNi4wNzktLjk0N2gtNC4xNVoiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDI1LjM4MiAxNy45OTQpIi8+PC9nPjwvc3ZnPg==)

### 🚀 Installation
#### Install the package via Composer.
```` bash
composer require ayvazyan10/ameriabankvpos
````
#### Release the configuration file and database migration.
```` bash
php artisan vendor:publish --provider="Ayvazyan10\AmeriaBankVPOS\AmeriaBankVPOSServiceProvider"
````
This will create a [config/ameriabankvpos.php] and [database/migrations] files in your application.
```` bash
php artisan migrate
````
### ⚙️ Configuration
After publishing the configuration file, you should set your AmeriaBank VPOS credentials/options in the config/ameriabankvpos.php file or in your .env file:
```` ini
AMERIABANKVPOS_CLIENT_ID=your_client_id
AMERIABANKVPOS_USERNAME=your_username
AMERIABANKVPOS_PASSWORD=your_password
AMERIABANKVPOS_BACK_URL=your_back_url_route_name
AMERIABANKVPOS_TEST_MODE=true_or_false
AMERIABANKVPOS_CURRENCY=your_currency
AMERIABANKVPOS_LANGUAGE=your_language
````
### 📚 Usage
Here is an example of how to use the AmeriaBankVPOS facade or helper in your Laravel application:
```` php
use Ayvazyan10\AmeriaBankVPOS\Facades\AmeriaBankVPOS;

// Process the payment with facade and redirect to AmeriaBank payment interface
AmeriaBankVPOS::pay($amount, $orderId, $description, $currency, $language);

// or with helper

// Process the payment with helper and redirect to AmeriaBank payment interface
ameriabank()->pay($amount, $orderId, $description, $currency, $language);

// Check the payment status and return the transaction details
$response = AmeriaBankVPOS::check($request);

// or with helper

$response = ameriabank()->check($request);

// Retrieve data from the transaction
if ($response['status'] === 'SUCCESS') {
    $transaction = $response['transaction'];

    $order_id = $transaction->order_id;
    $user_id = $transaction->user_id;
    $payment_id = $transaction->payment_id;
    $provider = $transaction->Provider;
    // more fields as needed ...
    // you can find all fields in ameriabank_transactions table
}
````
### 📋 Statuses
This package returns the payment status as a string in the status key of the response array. The possible statuses are:

- SUCCESS: The payment has been successfully processed.
- FAIL: The payment failed or was declined.

### ⚡ All Methods
```` php
public function cancelPayment(int|string $paymentId): array;

public function check($request): array;

public function getPaymentDetails(int|string $paymentId): array;

public function pay(
    int|float $amount,
    int       $orderId,
    string    $description = null,
    string    $currency = null,
    string    $language = null
): void;

public function refund(int|string $paymentId, int|float $refundAmount): array;
````

### 📖 Examples
Below are some examples on how to use the package in different scenarios.
### Example 1: Simple Payment
``` php
use Ayvazyan10\AmeriaBankVPOS\Facades\AmeriaBankVPOS;

$amount = 100; // minimum amount while testing is 10 AMD
$orderId = 1; // in test mode order id should be from 2923001 to 2924000
$description = 'Test Payment'; // optional

AmeriaBankVPOS::pay($amount, $orderId, $description);
```
### Example 2: Payment with Custom Currency and Language
``` php
use Ayvazyan10\AmeriaBankVPOS\Facades\AmeriaBankVPOS;

$amount = 100;
$orderId = 1;
$description = 'Test Payment'; // optional
$currency = 'USD'; // optional
$language = 'en'; // optional

AmeriaBankVPOS::pay($amount, $orderId, $description, $currency, $language);
```
### Example 3: Handling the Payment Response
```` php
use Ayvazyan10\AmeriaBankVPOS\Facades\AmeriaBankVPOS;
use Illuminate\Http\Request;

// In your controller method, where you handle the payment response
public function handlePaymentResponse(Request $request)
{
    $response = AmeriaBankVPOS::check($request);

    if ($response['status'] === 'SUCCESS') {
        // Handle successful payment
        $transaction = $response['transaction'];
        // You can retrieve additional transaction data as needed
        // For example: $transaction->order_id, $transaction->user_id, etc.
    } else {
        // Handle failed payment
        // Also can retrieve additional transaction data as needed
    }
}
````
### Example 4: Getting the Payment Details
```` php
use Ayvazyan10\AmeriaBankVPOS\Facades\AmeriaBankVPOS;
use Exception;

// In your controller method or anywhere else
public function giveMeID($payment_id)
{
    try {
        // Actual payment ID to be retrieved
        $paymentDetails = AmeriaBankVPOS::getPaymentDetails($paymentId);
        
        // Will return details in array
        // Handle payment details as needed
        // For example: $paymentDetails['ApprovedAmount'], $paymentDetails['Description'], etc...
    } catch (Exception $e) {
        // Handle exception as needed
        // For example: Log the error or return an error response
    }
}
````
### Example 5: Refunding a specific payment
```` php
use Ayvazyan10\AmeriaBankVPOS\Facades\AmeriaBankVPOS;
use Exception;

// In your controller method or anywhere else
public function refundPayment($paymentId, $refundAmount)
{
    try {
        // Refund a specific payment partially
        $refundDetails = AmeriaBankVPOS::refund($paymentId, $refundAmount);
        
        // Will return refund status and details in array
        // Handle refund details as needed
        // For example: $refundDetails['status'], $refundDetails['response']['ResponseCode'], etc...
    } catch (Exception $e) {
        // Handle exception as needed
        // For example: Log the error or return an error response
    }
}
````
This method sends an API request to refund a specific payment partially. It takes two parameters:

$paymentId: The ID of the payment to be refunded. This parameter is required and can be an integer or string value.
$refundAmount: The amount to be refunded. This parameter is required and can be an integer or float value.
The method returns an associative array with two keys:

"status": Indicates the status of the refund operation. Possible values are "SUCCESS" or "FAIL".
"response": Contains the response data from the API. If the refund operation is successful, the response data will contain details about the refunded amount, otherwise it will contain an error message.
If an error occurs during the API request, the method will throw an exception with a message describing the error.
### Example 6: Canceling payment
```` php
use Ayvazyan10\AmeriaBankVPOS\Facades\AmeriaBankVPOS;
use Exception;

// In your controller method or anywhere else
public function cancelPayment($paymentId)
{
    try {
        // Cancel a specific payment
        $cancellationDetails = AmeriaBankVPOS::cancelPayment($paymentId);
        
        // Will return cancellation status and details in array
        // Handle cancellation details as needed
        // For example: $cancellationDetails['status'], $cancellationDetails['response']['ResponseCode'], etc...
    } catch (Exception $e) {
        // Handle exception as needed
        // For example: Log the error or return an error response
    }
}
````
In this example, the cancelPayment method is called with the $paymentId parameter. Inside the try block, the AmeriaBankVPOS::cancelPayment() method is called with the provided payment ID to initiate a payment cancellation operation. The method returns an associative array with two keys: "status" and "response". These keys contain the cancellation status and details respectively.

After calling the cancelPayment method, you can handle the returned details as needed. For example, you can check the "status" key to see if the cancellation was successful or not, and use the "response" key to get more details about the cancellation operation. In case an exception is thrown during the API request, the catch block will be executed and you can handle the error as needed, such as logging it or returning an error response.

### 🛠️ Extending and Customizing
If you need to extend or customize the package behavior, you can create your own class that extends the AmeriaBankVPOS class and override the methods as needed. Make sure to update the AmeriaBankVPOS alias in config/app.php to point to your custom class.

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email ayvazyan403@gmail.com instead of using the issue tracker.

## Author

- <a href="https://github.com/ayvazyan10">Razmik Ayvazyan</a>

## License

MIT. Please see the [license file](license.md) for more information.
