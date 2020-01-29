<?php
namespace AppBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;




class ParteType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
          ->add('localizacion', TextType::class, array ('label' => "Unidad donde se realiza la intervención"))
          ->add('trabajador', TextType::class, array ('label' => "Trabajador que la realiza"))
          ->add('fechainicio', DateType::class, array ('label' => "Fecha de inicio de los trabajos"))
          ->add('fechafin', DateType::class, array ('label' => "Fecha de finalización de los trabajos"))
          ->add('descripcion', TextareaType::class, array ('label' => "Trabajos realizados"))
          ->add('Registrar', SubmitType::class, array('label' => 'Registrar'))
          ;

  }

}
