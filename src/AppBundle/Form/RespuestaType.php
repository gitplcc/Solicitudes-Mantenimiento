<?php
namespace AppBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;


class RespuestaType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
          ->add('satisfaccion', ChoiceType::class,  ['label'=>'Seleccione de 0 a 10 su grado de satisfacción:', 'choices'  => ['0' => 0, '1' => 1, '2' => 2, '3' => 3, '4' => 4, '5' => 5, '6' => 6, '7' => 7, '8' => 8, '9' => 9, '10' => 10,],],)
          ->add('observaciones', TextType::class, array('label' => 'Observaciones a los trabajos realizados:'))
          ->add('Registrar', SubmitType::class, array('label' => 'Aceptar'))

          ;
    }
 }
