<?php

namespace App\Services;

class DiscountService
{
    public function calculate($amount, $discount)
    {
        if ($discount < 0 || $discount > 100) {
            throw new \InvalidArgumentException('Discount must be between 0 and 100.');
        }

        return $amount - ($amount * ($discount / 100));
    }
}
