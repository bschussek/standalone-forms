<?php

use Symfony\Component\Validator\Constraints\MinLength;
use Symfony\Component\Validator\Constraints\NotBlank;

require __DIR__ . '/../vendor/autoload.php';

require __DIR__ . '/../src/setup.php';

// Create our first form!
$form = $formFactory->createNamedBuilder('my_form_name_here','form')
    ->setAction('#')
    ->setMethod('POST')
    ->add('firstName', 'text', array(
        'constraints' => array(
            new NotBlank(),
            new MinLength(4),
        ),
    ))
    ->add('lastName', 'text', array(
        'constraints' => array(
            new NotBlank(),
            new MinLength(4),
        ),
    ))
    ->add('gender', 'choice', array(
        'choices' => array('m' => 'Male', 'f' => 'Female'),
    ))
    ->add('newsletter', 'checkbox', array(
        'required' => false,
    ))
    ->getForm();

if ($form->isSubmitted()) {
    $form->bind($_POST[$form->getName()]);

    if ($form->isValid()) {
        var_dump('VALID', $form->getData());
        die;
    }
}

echo $twig->render('index.html.twig', array(
    'form' => $form->createView(),
));
