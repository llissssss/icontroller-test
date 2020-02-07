<?php

namespace App\Service;

use App\Entity\SalaryDate;
use App\Entity\SalaryDateCollection;
use App\ValueObject\Year;

class SalaryDueDateCalculator
{
    public function calculate(Year $year): SalaryDateCollection
    {
        $result = new SalaryDateCollection();
        foreach (range(1, 12) as $month) {
            $date = \DateTimeImmutable::createFromFormat(
                'Y-m-d',
                sprintf(
                    '%d-%d-%d',
                    $year->getValue(),
                    $month,
                    1
                )
            );
            $baseSalaryDueDate = $this->getBaseSalaryDueDate($date);
            $bonusDueDate = $this->getBonusDueDate($date);

            $dueDate = new SalaryDate($date, $baseSalaryDueDate, $bonusDueDate);

            $result->add($dueDate);
        }

        return $result;

    }

    /**
     * @param \DateTimeImmutable $date
     * @return \DateTimeImmutable
     */
    private function getBaseSalaryDueDate(\DateTimeImmutable $date)
    {
        $baseDueDate = $date->modify('last day of this month');

        if ($this->isWeekend($baseDueDate)) {
            return $baseDueDate->modify('last friday of this month');
        }

        return $baseDueDate;
    }

    /**
     * @param \DateTimeImmutable $date
     * @return \DateTimeImmutable
     */
    private function getBonusDueDate(\DateTimeImmutable $date)
    {
        $bonusDueDate = $date->modify('+14 days');

        if ($this->isWeekend($bonusDueDate)) {
            return $bonusDueDate->modify('next wednesday');
        }
        return $bonusDueDate;
    }

    /**
     *
     * @param \DateTimeImmutable $date
     * @return bool
     */
    private function isWeekend(\DateTimeImmutable $date)
    {
        return in_array($date->format('w'), [0, 6]);
    }
}
