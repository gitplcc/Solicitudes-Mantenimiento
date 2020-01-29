<?php
namespace AppBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;



class TaskType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
          ->add('desde', DateTimeType::class, array('label' => 'Desde'))
          ->add('hasta', DateType::class, array('label' => 'Hasta'))
          ->add('Aceptar', SubmitType::class, array('label' => 'Aceptar'))

          ;

  }

}
