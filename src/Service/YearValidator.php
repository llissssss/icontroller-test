<?php

namespace App\Service;

use App\ValueObject\Year;

class YearValidator
{
    /**
     * @param Year $year
     * @return bool
     */
    public function isValid(Year $year): bool
    {
        return \DateTimeImmutable::createFromFormat('Y', $year->getValue()) !== false;
    }
}