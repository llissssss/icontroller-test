<?php

namespace App\Entity;

class SalaryDate
{
    /**
     * @var \DateTimeInterface
     */
    private $date;
    /**
     * @var \DateTimeInterface
     */
    private $baseSalaryDueDate;
    /**
     * @var \DateTimeInterface
     */
    private $bonusDueDate;

    /**
     * SalaryDate constructor.
     * @param \DateTimeInterface $month
     * @param \DateTimeInterface $baseSalaryDueDate
     * @param \DateTimeInterface $bonusDueDate
     */
    public function __construct(\DateTimeInterface $month, \DateTimeInterface $baseSalaryDueDate, \DateTimeInterface $bonusDueDate)
    {
        $this->date = $month;
        $this->baseSalaryDueDate = $baseSalaryDueDate;
        $this->bonusDueDate = $bonusDueDate;
    }

    /**
     * @return string
     */
    public function getMonthAsString(): string
    {
        return $this->date->format('F');
    }

    /**
     * @return string
     */
    public function getBaseSalaryDueDateAsString(): string
    {
        return $this->baseSalaryDueDate->format('Y-m-d');
    }

    /**
     * @return string
     */
    public function getBonusDueDateAsString(): string
    {
        return $this->bonusDueDate->format('Y-m-d');
    }
}