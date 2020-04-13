<?php

namespace App;

class OrderTwo
{
    /**
     * Quantity
     * @var int
     */
    public $quantity;

    /**
     * Unit Price
     * @var float
     */
    public $unitPrice;

    /**
     * Amount
     * @var float
     */
    public $amount;

    /**
     * Constructor
     * 
     * @param int $quantity Qauntity
     * @param float $unitPrice Unit price
     * 
     * @return void
     */
    public function __construct(int $quantity, float $unitPrice)
    {
        $this->quantity = $quantity;
        $this->unitPrice = $unitPrice;

        $this->amount = $this->quantity * $this->unitPrice;
    }

    /**
     * Process the order with total amount
     * 
     * @param PaymentGateway $gateway Payment Gateway object
     * 
     * @return void
     */
    public function process(PaymentGateway $gateway)
    {
        $gateway->charge($this->amount);
    }
}