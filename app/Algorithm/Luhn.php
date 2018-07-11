<?php
/**
 * Created by PhpStorm.
 * User: riveng
 * Date: 2018. 07. 09.
 * Time: 22:30
 */

namespace Homework\Algorithm;


use InvalidArgumentException;

class Luhn implements AlgorithmInterface
{
    public function calcChecksum(int $number): int
    {
        $number = (string)$number;
        $nDigits = strlen($number) + 1;
        $parity = $nDigits % 2;
        $checksum = 0;
        for ($i = 0; $i < $nDigits - 1; $i++) {
            $digit = (int)$number[$i];
            if (($i % 2) === $parity) {
                $digit *= 2;
                if ($digit > 9) {
                    $digit -= 9;
                }
            }
            $checksum += $digit;
        }
        return $checksum;
    }

    public function calcCheckDigit(int $number): int
    {
        $checksum = $this->calcChecksum($number);

        $checkDigit = $checksum % 10;
        return $checkDigit === 0 ? $checkDigit : 10 - $checkDigit;
    }

    public function generateNumber($partialValue): int
    {
        if (!preg_match('/^\d+$/', $partialValue)) {
            throw new InvalidArgumentException('Argument should be an integer.');
        }

        return $partialValue . $this->calcCheckDigit((int)$partialValue);
    }
}