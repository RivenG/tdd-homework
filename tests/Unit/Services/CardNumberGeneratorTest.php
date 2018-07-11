<?php

namespace Tests\Unit\Services;

use Homework\Algorithm\Luhn;
use Homework\Services\CardNumberGenerator;
use Tests\TestCase;

class CardNumberGeneratorTest extends TestCase
{
    /**
     * @test
     */
    public function testGenerateRandomCardNumber_MockObjectGiven_NoneZeroFirstExcepted()
    {
        $luhnStub = $this->createMock(Luhn::class);
        $luhnStub->method('generateNumber')
            ->willReturn('5105105105105100');

        $generator = new CardNumberGenerator($luhnStub);
        $actual = $generator->generateRandomCardNumber();

        $this->assertRegExp('/^\d+/', (string) $actual);
    }

    /**
     * @test
     */
    public function testGenerateRandomCardNumber_MockObjectGiven_MockReturnExcepted()
    {
        $luhnStub = $this->createMock(Luhn::class);
        $luhnStub->method('generateNumber')
            ->willReturn('5105105105105100');

        $generator = new CardNumberGenerator($luhnStub);
        $actual = $generator->generateRandomCardNumber();

        $this->assertEquals(5105105105105100, $actual);
    }

    /**
     * @test
     */
    public function testGenerateRandomCardNumber_MockObjectGiven_16digitsExcepted()
    {
        $luhnStub = $this->createMock(Luhn::class);
        $luhnStub->method('generateNumber')
            ->willReturn('5105105105105100');

        $generator = new CardNumberGenerator($luhnStub);
        $actual = $generator->generateRandomCardNumber();

        $this->assertEquals(16, strlen((string)$actual));
    }
}
