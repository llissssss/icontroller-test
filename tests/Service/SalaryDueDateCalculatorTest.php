<?php

namespace App\Tests\Service;

use App\Entity\SalaryDate;
use App\ValueObject\Year;
use App\Service\SalaryDueDateCalculator;
use PHPUnit\Framework\TestCase;

class SalaryDueDateCalculatorTest extends TestCase
{
    /**
     * @dataProvider calculateDataProvider
     * @param int $inputYear
     * @param array $expectedResults
     */
    public function testCalculate(int $inputYear, array $expectedResults)
    {
        $calculator = new SalaryDueDateCalculator();
        $year = new Year();
        $year->setValue($inputYear);
        $result = $calculator->calculate($year);

        /**
         * @var int $key
         * @var SalaryDate $value
         */
        foreach ($result as $key => $value) {
            $this->assertEquals($expectedResults[$key]['month'], $value->getMonthAsString());
            $this->assertEquals($expectedResults[$key]['salaryDueDate'], $value->getBaseSalaryDueDateAsString());
            $this->assertEquals($expectedResults[$key]['bonusDueDate'], $value->getBonusDueDateAsString());
        }
    }

    /**
     * @return array
     */
    public function calculateDataProvider()
    {
        return [
            '2019' => [
                '2019',
                [
                    ['month' => 'January', 'salaryDueDate' => '2019-01-31', 'bonusDueDate' => '2019-01-15'],
                    ['month' => 'February', 'salaryDueDate' => '2019-02-28', 'bonusDueDate' => '2019-02-15'],
                    ['month' => 'March', 'salaryDueDate' => '2019-03-29', 'bonusDueDate' => '2019-03-15'],
                    ['month' => 'April', 'salaryDueDate' => '2019-04-30', 'bonusDueDate' => '2019-04-15'],
                    ['month' => 'May', 'salaryDueDate' => '2019-05-31', 'bonusDueDate' => '2019-05-15'],
                    ['month' => 'June', 'salaryDueDate' => '2019-06-28', 'bonusDueDate' => '2019-06-19'],
                    ['month' => 'July', 'salaryDueDate' => '2019-07-31', 'bonusDueDate' => '2019-07-15'],
                    ['month' => 'August', 'salaryDueDate' => '2019-08-30', 'bonusDueDate' => '2019-08-15'],
                    ['month' => 'September', 'salaryDueDate' => '2019-09-30', 'bonusDueDate' => '2019-09-18'],
                    ['month' => 'October', 'salaryDueDate' => '2019-10-31', 'bonusDueDate' => '2019-10-15'],
                    ['month' => 'November', 'salaryDueDate' => '2019-11-29', 'bonusDueDate' => '2019-11-15'],
                    ['month' => 'December', 'salaryDueDate' => '2019-12-31', 'bonusDueDate' => '2019-12-18'],
                ]
            ],
            '2020' => [
                '2020',
                [
                    ['month' => 'January', 'salaryDueDate' => '2020-01-31', 'bonusDueDate' => '2020-01-15'],
                    ['month' => 'February', 'salaryDueDate' => '2020-02-28', 'bonusDueDate' => '2020-02-19'],
                    ['month' => 'March', 'salaryDueDate' => '2020-03-31', 'bonusDueDate' => '2020-03-18'],
                    ['month' => 'April', 'salaryDueDate' => '2020-04-30', 'bonusDueDate' => '2020-04-15'],
                    ['month' => 'May', 'salaryDueDate' => '2020-05-29', 'bonusDueDate' => '2020-05-15'],
                    ['month' => 'June', 'salaryDueDate' => '2020-06-30', 'bonusDueDate' => '2020-06-15'],
                    ['month' => 'July', 'salaryDueDate' => '2020-07-31', 'bonusDueDate' => '2020-07-15'],
                    ['month' => 'August', 'salaryDueDate' => '2020-08-31', 'bonusDueDate' => '2020-08-19'],
                    ['month' => 'September', 'salaryDueDate' => '2020-09-30', 'bonusDueDate' => '2020-09-15'],
                    ['month' => 'October', 'salaryDueDate' => '2020-10-30', 'bonusDueDate' => '2020-10-15'],
                    ['month' => 'November', 'salaryDueDate' => '2020-11-30', 'bonusDueDate' => '2020-11-18'],
                    ['month' => 'December', 'salaryDueDate' => '2020-12-31', 'bonusDueDate' => '2020-12-15'],
                ]
            ],
            '2049' => [
                '2049',
                [
                    ['month' => 'January', 'salaryDueDate' => '2049-01-29', 'bonusDueDate' => '2049-01-15'],
                    ['month' => 'February', 'salaryDueDate' => '2049-02-26', 'bonusDueDate' => '2049-02-15'],
                    ['month' => 'March', 'salaryDueDate' => '2049-03-31', 'bonusDueDate' => '2049-03-15'],
                    ['month' => 'April', 'salaryDueDate' => '2049-04-30', 'bonusDueDate' => '2049-04-15'],
                    ['month' => 'May', 'salaryDueDate' => '2049-05-31', 'bonusDueDate' => '2049-05-19'],
                    ['month' => 'June', 'salaryDueDate' => '2049-06-30', 'bonusDueDate' => '2049-06-15'],
                    ['month' => 'July', 'salaryDueDate' => '2049-07-30', 'bonusDueDate' => '2049-07-15'],
                    ['month' => 'August', 'salaryDueDate' => '2049-08-31', 'bonusDueDate' => '2049-08-18'],
                    ['month' => 'September', 'salaryDueDate' => '2049-09-30', 'bonusDueDate' => '2049-09-15'],
                    ['month' => 'October', 'salaryDueDate' => '2049-10-29', 'bonusDueDate' => '2049-10-15'],
                    ['month' => 'November', 'salaryDueDate' => '2049-11-30', 'bonusDueDate' => '2049-11-15'],
                    ['month' => 'December', 'salaryDueDate' => '2049-12-31', 'bonusDueDate' => '2049-12-15'],
                ]
            ],
        ];
    }
}
