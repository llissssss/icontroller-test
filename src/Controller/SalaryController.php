<?php

namespace App\Controller;

use App\Service\YearValidator;
use App\ValueObject\Year;
use App\Service\SalaryDueDateCalculator;
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
            'year' => $year->getValue()
        ]);
    }

}