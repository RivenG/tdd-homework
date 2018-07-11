<?php


namespace Homework\Services;


use Homework\Algorithm\AlgorithmInterface;
use InvalidArgumentException;

class CardNumberGenerator
{
    protected $algorithm;

    public function __construct(AlgorithmInterface $algorithm)
    {
        $this->algorithm = $algorithm;
    }

    public function generateRandomCardNumber(): int
    {
        $number = $this->generateRandomNumber(15);
        return $this->algorithm->generateNumber($number);
    }

    protected function generateRandomNumber(int $length): int
    {
        if ($length == 0) {
            throw new InvalidArgumentException('Argument should be bigger then zero.');
        }

        $number = rand(1, 9);

        for ($i = 2; $i <= $length; $i++) {
            $number .= rand(0, 9);
        }

        return $number;
    }
}