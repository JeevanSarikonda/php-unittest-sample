<?php
use PHPUnit\Framework\TestCase;
use App\Order;

class OrderTest extends TestCase
{
    public function tearDown(): void
    {
        \Mockery::close();
    }

    public function test_OrderIsProcessed()
    {
        $gateway = $this->getMockBuilder('App\PaymentGateway')
                        ->setMethods(['charge'])
                        ->getMock();

        $gateway->method('charge')->willReturn(true);
       
        $order = new Order($gateway);
        $order->amount = 200;

        $this->assertTrue($order->process());

    }

    public function test_OrderIsProcessedUsingMockery()
    {
        $gateway = Mockery::mock('App\PaymentGateway');
        $gateway->shouldReceive('charge')
                ->once()
                ->with(200)
                ->andReturn(true);

        $order = new Order($gateway);
        $order->amount = 200;

        $this->assertTrue($order->process());
    }
}