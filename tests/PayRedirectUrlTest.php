<?php

namespace Ayvazyan10\AmeriaBankVPOS\Tests;

use Ayvazyan10\AmeriaBankVPOS\AmeriaBankVPOS;
use Ayvazyan10\AmeriaBankVPOS\AmeriaBankVPOSServiceProvider;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Orchestra\Testbench\TestCase;

class PayRedirectUrlTest extends TestCase
{
    protected function getPackageProviders($app): array
    {
        return [AmeriaBankVPOSServiceProvider::class];
    }

    protected function defineEnvironment($app): void
    {
        // pay() builds the redirect against the test host and uses the configured language.
        $app['config']->set('ameriabankvpos.TestMode', true);
        $app['config']->set('ameriabankvpos.Language', 'en');
        $app['config']->set('ameriabankvpos.StoreTransactions', false);
    }

    protected function defineRoutes($router): void
    {
        // Constructor resolves route(config('ameriabankvpos.BackUrl')) which defaults to 'home'.
        $router->get('/', static fn () => '')->name('home');
    }

    private function fakeInitPayment(): void
    {
        Http::fake([
            '*/VPOS/api/VPOS/InitPayment' => Http::response([
                'ResponseCode' => 1,
                'PaymentID' => 'PID',
                'OrderID' => 2923001,
            ]),
        ]);
    }

    public function test_apple_pay_type_is_appended(): void
    {
        $this->fakeInitPayment();

        $result = (new AmeriaBankVPOS)->pay(10, 2923001, ['Type' => AmeriaBankVPOS::PAYMENT_TYPE_APPLE_PAY]);

        $this->assertSame('SUCCESS', $result['status']);
        $this->assertStringEndsWith('&type=13', $result['redirectUrl']);
    }

    public function test_card_type_is_appended(): void
    {
        $this->fakeInitPayment();

        $result = (new AmeriaBankVPOS)->pay(10, 2923001, ['Type' => 5]);

        $this->assertStringEndsWith('&type=5', $result['redirectUrl']);
    }

    public function test_missing_type_falls_back_to_auto_detect(): void
    {
        $this->fakeInitPayment();

        $result = (new AmeriaBankVPOS)->pay(10, 2923001);

        $this->assertStringNotContainsString('&type=', $result['redirectUrl']);
    }

    /**
     * @dataProvider invalidTypes
     * @param mixed $type
     */
    public function test_invalid_type_is_ignored($type): void
    {
        $this->fakeInitPayment();

        $result = (new AmeriaBankVPOS)->pay(10, 2923001, ['Type' => $type]);

        $this->assertStringNotContainsString('&type=', $result['redirectUrl']);
    }

    public static function invalidTypes(): array
    {
        return [
            'non-numeric string' => ['x'],
            'unknown numeric' => [99],
            'binding type' => [6],
            'zero' => [0],
        ];
    }
}
