<?php
namespace App\NumberAdder;

class NumberAdder 
{
    public $firstNumber;
    public $secondNumber;

    public function __construct(int $firstNumber, int $secondNumber)
    {
        $this->firstNumber = $firstNumber;
        $this->secondNumber = $secondNumber;
    }

    public function add(): int
    {
        return $this->firstNumber + $this->secondNumber;
    }
}