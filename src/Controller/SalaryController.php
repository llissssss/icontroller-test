<?php

namespace App\Controller;

use App\ValueObject\Year;
use App\Service\SalaryDeadlineCalculator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class SalaryController extends AbstractController {

    public function index(Request $request, SalaryDeadlineCalculator $salaryCalculator)
    {
        $year = new Year();

        $form = $this->createFormBuilder($year)
            ->add('value', NumberType::class)
            ->add('submit', SubmitType::class, ['label' => 'Obtain salary deadlines'])
            ->getForm();

        $form->handleRequest($request);

        $result = $salaryCalculator->calculate($year);

        return $this->render('salary/index.html.twig', [
            'form' => $form->createView(),
            'result' => $result
        ]);
    }
}