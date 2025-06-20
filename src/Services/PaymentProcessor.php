<?php
namespace GreenStreet\Extension\Services;
interface PaymentProcessor
{
    public function process(array $transaction): void;
}