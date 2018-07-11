<?php

namespace Tests\Unit;

use Homework\Algorithm\Luhn;
use InvalidArgumentException;
use Tests\TestCase;

class LuhnTest extends TestCase
{
    public function checksumProvider()
    {
        return [
            [7992739871, 67],
            [3852000002323, 33],
            [37144963539843, 79],
            [561059108101825, 40],
            [601100099013942, 46],
            [510510510510510, 20],
            [7992739871, 67],
            [3852000002323, 33],
            [37144963539843, 79],
            [561059108101825, 40],
            [601100099013942, 46],
            [510510510510510, 20],
        ];
    }

    /**
     * @test
     * @dataProvider checksumProvider
     */
    public function testCalcChecksum_NumberFromProviderGiven_NumberFromProviderExcepted($number, $expected)
    {
        $this->assertEquals($expected, (new Luhn)->calcChecksum($number));
    }

    public function checkDigitProvider()
    {
        return [
            [7992739871, 3],
            [3852000002323, 7],
            [37144963539843, 1],
            [561059108101825, 0],
            [601100099013942, 4],
            [510510510510510, 0],
            [7992739871, 3],
            [3852000002323, 7],
            [37144963539843, 1],
            [561059108101825, 0],
            [601100099013942, 4],
            [510510510510510, 0],
        ];
    }

    /**
     * @test
     * @dataProvider checkDigitProvider
     */
    public function testCalcCheckDigit_NumberFromProviderGiven_NumberFromProviderExcepted($number, $expected)
    {
        $this->assertEquals($expected, (new Luhn)->calcCheckDigit($number));
    }

    public function generateNumberProvider()
    {
        return [
            [7992739871, 79927398713],
            [3852000002323, 38520000023237],
            [37144963539843, 371449635398431],
            [561059108101825, 5610591081018250],
            [601100099013942, 6011000990139424],
            [510510510510510, 5105105105105100],
            [7992739871, 79927398713],
            [3852000002323, 38520000023237],
            [37144963539843, 371449635398431],
            [561059108101825, 5610591081018250],
            [601100099013942, 6011000990139424],
            [510510510510510, 5105105105105100],
        ];
    }

    /**
     * @test
     * @dataProvider generateNumberProvider
     */
    public function testGenerateNumber_NumberFromProviderGiven_NumberFromProviderExcepted($number, $expected)
    {
        $this->assertEquals($expected, (new Luhn)->generateNumber($number));
    }

    public function generateNotNumberProvider()
    {
        return [
            ['a'],
            ['a034']
        ];
    }

    /**
     * @test
     * @dataProvider generateNotNumberProvider
     */
    public function testGenerateNumber_NotNumberFromProviderGiven_ExceptionExcepted($number)
    {
        $this->expectException(InvalidArgumentException::class);
        (new Luhn)->generateNumber($number);
    }

}
