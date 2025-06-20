<?php

namespace GreenStreet\Extension\Services;

final class Strtipe implements PaymentProcessor
{
    public function __construct(private array $config = [],
                                private SalesTaxCalculator $salesTaxCalculator)
    {

    }

    public function process(array $transaction): void
    {
        // Implement Stripe payment processing logic here
        // This is a placeholder implementation
        echo "Processing transaction with Stripe: " . json_encode($transaction);
    }
}