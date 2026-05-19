<?php

namespace Ayvazyan10\AmeriaBankVPOS;

use Illuminate\Http\Request;

interface AmeriaInterface
{
    /**
     * @param int|string $paymentId
     */
    public function cancelPayment($paymentId): array;

    public function check(Request $request): array;

    /**
     * @param int|string $paymentId
     */
    public function getPaymentDetails($paymentId): array;

    /**
     * @param int|float $amount
     */
    public function pay($amount, int $orderId, array $options = []): array;

    /**
     * @param int|string $paymentId
     * @param int|float $refundAmount
     */
    public function refund($paymentId, $refundAmount): array;

    /**
     * @param int|float $amount
     */
    public function makeBindingPayment($amount, int $orderId, array $options = []): array;

    public function getBindings(): array;

    public function deactivateBinding(string $cardHolderId): array;

    public function activateBinding(string $cardHolderId): array;
}
