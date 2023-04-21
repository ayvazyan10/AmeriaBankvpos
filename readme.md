<h1 align="left">AmeriaBank VPOS Laravel Package</h1>
<p align="left">
  This package provides a simple and convenient integration with AmeriaBank VPOS for Laravel applications.
</p>

## 🚀 Installation
#### Install the package via Composer:
```` bash
composer require ayvazyan10/ameriabank-vpos
````
#### Publish the configuration file if automatically publishing not working:
```` bash
php artisan vendor:publish --provider="Ayvazyan10\AmeriaBankVPOS\AmeriaBankVPOSServiceProvider"
````
This will create a config/ameriabankvpos.php file in your application.

## ⚙️ Configuration
After publishing the configuration file, you should set your AmeriaBank VPOS credentials and options in the config/ameriabankvpos.php file or in your .env file:
```` ini
AMERIABANKVPOS_CLIENT_ID=your_client_id
AMERIABANKVPOS_USERNAME=your_username
AMERIABANKVPOS_PASSWORD=your_password
AMERIABANKVPOS_BACK_URL=your_back_url_route_name
AMERIABANKVPOS_TEST_MODE=true_or_false
AMERIABANKVPOS_CURRENCY=your_currency
AMERIABANKVPOS_LANGUAGE=your_language
````
## 📚 Usage
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
    // you can find all fields in amerabank_transactions table
}
````
## 📋 Statuses
This package returns the payment status as a string in the status key of the response array. The possible statuses are:

- SUCCESS: The payment has been successfully processed.
- FAIL: The payment failed or was declined.

## 📖 Examples
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
    }
}

````

## 🛠️ Extending and Customizing
If you need to extend or customize the package behavior, you can create your own class that extends the AmeriaBankVPOS class and override the methods as needed. Make sure to update the AmeriaBankVPOS alias in config/app.php to point to your custom class.

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email ayvazyan403@gmail.com instead of using the issue tracker.

## Author

- <a href="https://github.com/ayvazyan10">Razmik Ayvazyan</a>

## License

MIT. Please see the [license file](license.md) for more information.
