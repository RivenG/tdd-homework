<?php
/**
 * Created by PhpStorm.
 * User: riveng
 * Date: 2018. 07. 10.
 * Time: 17:18
 */

namespace Homework\Services;


use InvalidArgumentException;

class AccountNumberGenerator
{
    public function generateRandomAccountNumber()
    {
        return '12345678-' . $this->generateRandomNumber(8);
    }

    protected function generateRandomNumber(int $length): string
    {
        if ($length == 0) {
            throw new InvalidArgumentException('Argument should be bigger then zero.');
        }

        $number = '';

        for ($i = 1; $i <= $length; $i++) {
            $number = $number . ((string) rand(0, 9));
        }

        return $number;
    }
}