<?php

use PHPUnit\Framework\TestCase;
use App\OrderTwo;

class OrderTwoTest extends TestCase
{

    public function tearDown(): void
    {
        \Mockery::close();
    }

    public function test_OrderIsProcessedUsingAMock()
    {
        $order = new OrderTwo(3, 1.49);

        $this->assertEquals(4.47, $order->amount);

        $gateway_mock = Mockery::mock('App\PaymentGateway');
        $gateway_mock->shouldReceive('charge')
                     ->once()
                     ->with(4.47);

        $order->process($gateway_mock);
    }

    public function test_OrderIsProcessedUsingASpy()
    {
        $order = new OrderTwo(3, 1.49);

        $this->assertEquals(4.47, $order->amount);

        $gateway_spy = Mockery::spy('App\PaymentGateway');

        $order->process($gateway_spy);

        $gateway_spy->shouldHaveReceived('charge')
                    ->once()
                    ->with(4.47);
    }
}