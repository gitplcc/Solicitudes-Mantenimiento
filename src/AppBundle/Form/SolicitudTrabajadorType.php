<?php
namespace AppBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


class SolicitudTrabajadorType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
          ->add('trabajador', TextType::class, array ('label' => "Trabajador al que se asigna la solicitud"))
          ->add('Registrar', SubmitType::class, array('label' => 'Registrar'))
          ;
    }
 }
