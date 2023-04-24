<h1 align="left">AmeriaBank VPOS Laravel Package</h1>
<p align="left">
  This package provides a simple and convenient integration with AmeriaBank VPOS for Laravel applications.
</p>

[![Buy me a coffee](https://img.shields.io/badge/Buy%20me%20a%20coffee-Donate-yellow?style=for-the-badge&logo=buymeacoffee)](https://www.buymeacoffee.com/ayvazyan403)


<svg xmlns="http://www.w3.org/2000/svg" width="144" height="46" viewBox="0 0 144 46"><defs><style>.a{fill:#ffffff;}</style></defs><g transform="translate(1053 -423)"><path class="a" d="M-1021.726,443.074l-5.586-19.277h-6.5l-5.588,19.277-5.283-19.277H-1053l8.71,28.366h8.993l4.737-15.912,4.737,15.912h8.989l8.71-28.366h-8.319Z" transform="translate(0 0.655)"/><path class="a" d="M-1012.6,423.486a14.758,14.758,0,0,0-14.611,14.9A14.759,14.759,0,0,0-1012.3,453a17.33,17.33,0,0,0,12.079-4.888l-4.372-3.972a10.028,10.028,0,0,1-7,2.749,7.08,7.08,0,0,1-7.53-6.515h21.134v-2.139C-997.99,430.061-1003.421,423.484-1012.6,423.486Zm-6.46,12.891a6.792,6.792,0,0,1,6.635-6.923c.209-.005.421,0,.63.013a6.472,6.472,0,0,1,6,6.91Z" transform="translate(20.931 0.399)"/><path class="a" d="M-996.657,423.744l-10.477-.011v28.485h10.477c.323.011.645.011.966,0A14.246,14.246,0,0,0-981.936,437.5,14.247,14.247,0,0,0-996.657,423.744Zm-.053,26.889h-8.692V425.309h8.692c.144,0,.286,0,.43,0a12.665,12.665,0,0,1,12.447,12.877A12.663,12.663,0,0,1-996.709,450.633Z" transform="translate(37.237 0.602)"/><path class="a" d="M-975.011,453.866a15.434,15.434,0,0,0,15.335-15.531A15.43,15.43,0,0,0-975.109,423h-.1a15.435,15.435,0,0,0-15.334,15.531A15.434,15.434,0,0,0-975.011,453.866Zm-9.709-25.156a13.57,13.57,0,0,1,9.567-3.994,13.571,13.571,0,0,1,13.62,13.522,13.57,13.57,0,0,1-13.523,13.618,13.571,13.571,0,0,1-13.618-13.522A13.568,13.568,0,0,1-984.719,428.71Z" transform="translate(50.676 0)"/><path class="a" d="M-1029.232,450.884l.969-.028v-6h-.969Z" transform="translate(19.336 17.999)"/><path class="a" d="M-1046.87,449.911a9.586,9.586,0,0,1-1.815.179c-1.282,0-2.47-.277-2.47-2.281,0-1.917,1.106-2.075,2.334-2.075a11.174,11.174,0,0,1,1.953.179l.217.04.078-.953-.184-.029a16.4,16.4,0,0,0-2.128-.184c-1.6,0-3.232.359-3.23,3.044v0c0,2.157,1.088,3.2,3.318,3.2a14.716,14.716,0,0,0,2.044-.186l.182-.029-.078-.953Z" transform="translate(0.727 17.938)"/><path class="a" d="M-1037.41,445.8l.081-.937h-5.127v6.018l5.037-.017.079-.947h-4.15v-1.586h3.621l.053-.947h-3.674V445.8Z" transform="translate(8.666 17.999)"/><path class="a" d="M-1023.67,449.509l-2.378-4.657h-1.091l3.1,6.017h.709l3.088-6h-1.082Z" transform="translate(21.03 17.992)"/><path class="a" d="M-1043.474,448.754c1.051,0,1.68-.732,1.68-1.957s-.628-1.937-1.683-1.937h-3.815v6.018h.969v-2.112h1.507l1.907,2.112h1.255l-1.909-2.122Zm.707-1.958c0,.639-.266,1.022-.711,1.022h-2.855v-2.01l2.855-.009C-1043.018,445.8-1042.766,446.153-1042.766,446.8Z" transform="translate(4.691 17.999)"/><path class="a" d="M-1033.987,445.8h2.411v5.063h.969V445.8h2.276l.079-.947h-5.734Z" transform="translate(15.463 17.995)"/><path class="a" d="M-1035.336,444.861l-3.079,6h1.06l.665-1.294h3.4l.72,1.414.148-.124h.885l-3.07-6Zm1.6,3.8h-2.5l1.253-2.454Z" transform="translate(11.86 17.999)"/><path class="a" d="M-990.519,450.887l.969-.042v-5.983h-.969Z" transform="translate(50.831 18)"/><path class="a" d="M-985,444.791h-.018a3.117,3.117,0,0,0-3.1,3.072,2.743,2.743,0,0,0,.5,2.055,2.741,2.741,0,0,0,1.809,1.1,2.721,2.721,0,0,0,.423.033,2.65,2.65,0,0,0,.4-.029,3.1,3.1,0,0,0,2.2-.925,3.092,3.092,0,0,0,.9-2.206,3.1,3.1,0,0,0-.925-2.2A3.092,3.092,0,0,0-985,444.791Zm2.173,3.161a1.846,1.846,0,0,1-.339,1.392,1.854,1.854,0,0,1-1.223.745,1.845,1.845,0,0,1-.567,0l-.029,0-.029,0a1.879,1.879,0,0,1-1.4-.363,1.882,1.882,0,0,1-.738-1.25,1.974,1.974,0,0,1,0-.576c0-1.5.66-2.168,2.168-2.17a1.918,1.918,0,0,1,2.161,1.631,2.124,2.124,0,0,1,.015.357h-.053Z" transform="translate(52.641 17.942)"/><path class="a" d="M-995.274,445.8h2.411v5.066l.969-.015V445.8h2.263l.079-.947h-5.722Z" transform="translate(46.946 17.996)"/><path class="a" d="M-978.2,449.215l-3.852-4.29-.061-.066h-.753v6.017h.969v-4.362l3.928,4.356.746-.02v-5.987h-.978Z" transform="translate(56.981 17.998)"/><path class="a" d="M-975.3,447.44c-1.2-.188-1.627-.3-1.627-.875,0-.607.448-.833,1.652-.833a12.611,12.611,0,0,1,2.106.179l.217.038.069-.953-.184-.027a17.754,17.754,0,0,0-2.215-.184c-.643,0-2.6,0-2.6,1.758,0,1.394,1.232,1.609,2.534,1.836l.18.031c1.026.173,1.561.288,1.561.851s-.53.823-1.8.825l-.022,0h0a14.593,14.593,0,0,1-2.285-.18l-.219-.033-.055.951.184.026a20.269,20.269,0,0,0,2.472.184c1.771,0,2.667-.592,2.667-1.758C-972.663,447.9-973.942,447.679-975.3,447.44Z" transform="translate(60.995 17.938)"/><path class="a" d="M-1003.483,444.861h-.981v6.017h5.039l.055-.656.3-.3h-4.416Z" transform="translate(39.473 17.999)"/><path class="a" d="M-1011.583,447.445c-1.206-.188-1.627-.3-1.627-.874,0-.607.448-.833,1.652-.833a12.53,12.53,0,0,1,2.106.179l.217.038.069-.953-.184-.027a17.766,17.766,0,0,0-2.215-.184c-.643,0-2.6,0-2.6,1.758,0,1.394,1.232,1.609,2.536,1.836l.177.031c1.028.171,1.563.288,1.563.851s-.53.823-1.8.825l-.026,0h-.005a14.709,14.709,0,0,1-2.285-.179l-.219-.036-.055.953.184.026a20.271,20.271,0,0,0,2.472.184c1.771,0,2.667-.592,2.667-1.758C-1008.947,447.908-1010.225,447.684-1011.583,447.445Z" transform="translate(31.498 17.942)"/><path class="a" d="M-995.3,448.519c0,1.375-1.3,1.523-1.862,1.523s-1.878-.148-1.878-1.523v-3.662h-.969v3.662c0,1.541,1.064,2.461,2.848,2.461s2.822-.9,2.822-2.461v-3.662h-.96Z" transform="translate(43.099 17.996)"/><path class="a" d="M-1006.6,444.8h-.016a3.119,3.119,0,0,0-3.1,3.07,2.759,2.759,0,0,0,.5,2.059,2.753,2.753,0,0,0,1.809,1.1,2.687,2.687,0,0,0,.421.031,2.672,2.672,0,0,0,.4-.027,3.093,3.093,0,0,0,2.2-.925,3.1,3.1,0,0,0,.9-2.206,3.1,3.1,0,0,0-.924-2.2A3.1,3.1,0,0,0-1006.6,444.8Zm2.174,3.161a1.859,1.859,0,0,1-.339,1.392,1.858,1.858,0,0,1-1.224.745,1.835,1.835,0,0,1-.565,0l-.027,0-.029,0a1.9,1.9,0,0,1-2.144-1.612,2.035,2.035,0,0,1,0-.576c0-1.5.661-2.168,2.168-2.17a1.9,1.9,0,0,1,1.417.37,1.9,1.9,0,0,1,.74,1.263,1.973,1.973,0,0,1,0,.528l0,.029Z" transform="translate(35.177 17.946)"/><path class="a" d="M-1020.822,448.334h3.621l.053-.947h-3.679V445.8h4.073l.079-.947h-5.115v6.018l5.039-.006.079-.947h-4.15Z" transform="translate(25.382 17.994)"/></g></svg>

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
