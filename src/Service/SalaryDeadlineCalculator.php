<?php

namespace App\Service;

use App\ValueObject\Year;

class SalaryDeadlineCalculator
{
    public function calculate(Year $year) : int {
        return $year->getValue() * 2;
    }
}