<?php
/**
 * Created by PhpStorm.
 * User: riveng
 * Date: 2018. 07. 10.
 * Time: 17:19
 */

namespace Tests\Unit\Services;


use Homework\Services\AccountNumberGenerator;
use PHPUnit\Framework\TestCase;

class AccountNumberGeneratorTest extends TestCase
{
    /**
     * @test
     */
    public function testGenerateRandomAccountNumber_17CharExcepted()
    {
        $generator = new AccountNumberGenerator();
        $actual = $generator->generateRandomAccountNumber();

        $this->assertEquals(17, strlen($actual));
    }

    /**
     * @test
     */
    public function testGenerateRandomAccountNumber_8digitsDash8digitsExcepted()
    {
        $generator = new AccountNumberGenerator();
        $actual = $generator->generateRandomAccountNumber();

        $this->assertRegExp('/^\d{8}-\d{8}$/', $actual);
    }

    /**
     * @test
     */
    public function testGenerateRandomAccountNumber_NotEqualsTwiceExcepted()
    {
        $generator = new AccountNumberGenerator();
        $actual = $generator->generateRandomAccountNumber();
        $excepted = $generator->generateRandomAccountNumber();

        $this->assertNotEquals($excepted, $actual);
    }
}