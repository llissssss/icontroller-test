<?php

namespace App\Tests\Service;

use App\ValueObject\Year;
use App\Service\SalaryDeadlineCalculator;
use PHPUnit\Framework\TestCase;

class SalaryDeadlineCalculatorTest extends TestCase
{
    public function testCalculate()
    {
        $calculator = new SalaryDeadlineCalculator();
        $year = new Year();
        $year->setValue(2019);
        $result = $calculator->calculate($year);

        // assert that your calculator added the numbers correctly!
        $this->assertEquals($year->getValue() * 2, $result);
    }
}
