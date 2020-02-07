<?php

namespace App\Controller;

use App\Entity\SalaryDate;
use App\Service\YearValidator;
use App\ValueObject\Year;
use App\Service\SalaryDueDateCalculator;
use League\Csv\Writer;
use SplTempFileObject;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SalaryController extends AbstractController
{
    /**
     * @param Request $request
     * @param SalaryDueDateCalculator $salaryCalculator
     * @param YearValidator $validator
     * @return Response
     */
    public function index(Request $request, SalaryDueDateCalculator $salaryCalculator, YearValidator $validator): Response
    {
        $year = new Year();

        $form = $this->createFormBuilder($year)
            ->add('value', NumberType::class)
            ->add('submit', SubmitType::class, ['label' => 'Submit'])
            ->getForm();

        $form->handleRequest($request);

        $error = null;
        $result = null;
        if ($form->isSubmitted()) {
            $error = sprintf('%d is not a valid year.', $year->getValue());;
            if ($validator->isValid($year)) {
                $error = null;
                $result = $salaryCalculator->calculate($year);
            }
        }


        return $this->render('salary/index.html.twig', [
            'form' => $form->createView(),
            'result' => $result,
            'error' => $error,
            'download_url' => $this->generateUrl('download_csv', [
                'year' => $year->getValue(),
            ]),
            'year' => $year->getValue()
        ]);
    }

    /**
     * @param Request $request
     * @param SalaryDueDateCalculator $salaryCalculator
     * @param YearValidator $validator
     * @return Response
     * @throws \League\Csv\CannotInsertRecord
     */
    public function download_csv(Request $request, SalaryDueDateCalculator $salaryCalculator, YearValidator $validator): Response
    {
        $year = new Year();
        $year->setValue($request->get('year'));

        if (!$validator->isValid($year)) {
            throw new \InvalidArgumentException('Invalid year');
        }

        $csv = Writer::createFromFileObject(new SplTempFileObject());
        $csv->insertOne(['month', 'base salary due date', 'bonus due date']);

        $result = $salaryCalculator->calculate($year);
        /** @var SalaryDate $month */
        foreach ($result as $month) {
            $csv->insertOne([$month->getMonthAsString(), $month->getBaseSalaryDueDateAsString(), $month->getBonusDueDateAsString()]);
        }

        return new Response($csv->getContent(), 200, [
            'Content-Encoding' => 'none',
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="due-dates.csv"',
            'Content-Description' => 'File Transfer',
        ]);
    }

}