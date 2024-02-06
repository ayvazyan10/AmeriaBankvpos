<h1 align="left">AmeriaBank VPOS Laravel Package</h1>
<p align="left">
  This package provides a simple and convenient integration with AmeriaBank VPOS for Laravel applications.
</p>

[![Buy me a coffee](https://img.shields.io/badge/Buy%20me%20a%20coffee-Donate-yellow?style=for-the-badge&logo=buymeacoffee)](https://www.buymeacoffee.com/ayvazyan403)

![Image Description](https://wedo.design/uploads/img/main/logo.svg)

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
AmeriaBankVPOS::pay($amount, $orderId, array $options);

// or with helper

// Process the payment with helper and get success response to redirect AmeriaBank payment interface
ameriabank()->pay($amount, $orderId, array $options);

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

- SUCCESS: The payment approved and can be processed.
- FAIL: The payment failed or was declined.

### ⚡ All Methods
```` php
public function cancelPayment(int|string $paymentId): array;

public function check($request): array;

public function getPaymentDetails(int|string $paymentId): array;

public function pay(int|float $amount, int $orderId, array $options = []): array;

public function refund(int|string $paymentId, int|float $refundAmount): array;

public function makeBindingPayment(int|float $amount, int $orderId, array $options = []): array

public function getBindings(): array;

public function deactivateBinding(string $cardHolderId): array;

public function activateBinding(string $cardHolderId): array;
````

### 📖 Examples
Below are some examples on how to use the package in different scenarios.
### Example 1: Simple Payment
``` php
use Ayvazyan10\AmeriaBankVPOS\Facades\AmeriaBankVPOS;

$amount = 100; // minimum amount while testing is 10 AMD
$orderId = 1; // in test mode order id should be from 2923001 to 2924000
$description = 'Test Payment'; // optional

$initPayment = AmeriaBankVPOS::pay($amount, $orderId, ['Description' => $description]);

if($initPayment['status'] === "SUCCESS") {
    // If you need to store payment id in your database
    // For get full response use: $initPayment['response'];
    $paymentId = $initPayment['paymentId'];
    // Redirect to AmeriaBank payment interface
    return redirect($initPayment['redirectUrl']);
}
```
### Example 2: Payment with Custom Currency and Language, also redirect to different page
``` php
use Ayvazyan10\AmeriaBankVPOS\Facades\AmeriaBankVPOS;

// NOTE. Array is optional and default data injecting from configuration file

$amount = 100;
$orderId = 1;
$description = 'Test Payment'; // optional
$currency = '840'; // optional - currency ISO code (current:USD)
$language = 'en'; // optional
$BackURL = route('my.rounte.name'); // or just url: "https://...."
$opaque = 'Some additional information';

$initPayment = AmeriaBankVPOS::pay($amount, $orderId, [
    'Currecny' => $currency,
    'Language' => $language,
    'BackURL' => $BackURL,
    'Opaque' = $opaque,
]);

if($initPayment['status'] === "SUCCESS") {
    // If you need to store payment id in your database
    // For get full response use: $initPayment['response'];
    $paymentId = $initPayment['paymentId'];
    // Redirect to AmeriaBank payment interface
    return redirect($initPayment['redirectUrl']);
}
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

### Example 7: Binding Payments (Subscribe User Card)
```` php
use Ayvazyan10\AmeriaBankVPOS\Facades\AmeriaBankVPOS;
use Exception;

// In your controller method or anywhere else
public function payForBinding()
{
    // We passing CardHolderID and say with it that this payment need to subscribe
    // for first time
    ameriabank()->pay(10, '3073028', [
        'BackURL' => 'http://127.0.0.1:8000/my-back-route',
        'CardHolderID' => 'EXAMPLEUNIQUESTRING'
    ]);
    
    // After that we can use EXAMPLEUNIQUESTRING to charge user card 
    // with simple post request

    try {
       $resp = ameriabank()->makeBindingPayment(10, '3073035', [
        'CardHolderID' => 'EXAMPLEUNIQUESTRING'
       ]);
       
       dd($resp); // Will return binding payment details in array
       // if all is ok. We charged user card.
    } catch (Exception $e) {
        // Handle exception as needed
        // For example: Log the error or return an error response
    }
}
````

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
