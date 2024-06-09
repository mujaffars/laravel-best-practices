<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\DiscountService;

class DiscountServiceTest extends TestCase
{
    // php artisan make:test DiscountServiceTest --unit
    public function test_calculate_discount()
    {
        $service = new DiscountService();

        $result = $service->calculate(100, 10);
        $this->assertEquals(90, $result);

        $result = $service->calculate(200, 25);
        $this->assertEquals(150, $result);
    }

    public function test_calculate_discount_with_invalid_discount()
    {
        $this->expectException(\InvalidArgumentException::class);

        $service = new DiscountService();
        $service->calculate(100, 110);
    }
}
