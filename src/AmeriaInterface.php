<?php

namespace Ayvazyan10\AmeriaBankVPOS;

interface AmeriaInterface
{
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
}
