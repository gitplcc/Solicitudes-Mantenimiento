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



class SolicitudType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
          ->add('solicitante', TextType::class, array ('label' => "Nombre del solicitante"))
          ->add('destino', TextType::class, array ('label' => "Unidad de Destino"))
          ->add('extension', TextType::class, array ('label' => "Extensión"))
          ->add('email', EmailType::class)
          ->add('fecha', DateType::class)
          ->add('descripcionIncidencia', TextType::class, array ('label' => "Incidencia detectada"))
          ->add('estancia', TextType::class, array ('label' => "localización de la incidencia"))
          ->add('Registrar', SubmitType::class, array('label' => 'Registrar'))

          ;

  }

}
