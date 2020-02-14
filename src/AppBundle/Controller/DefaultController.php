<?php

namespace AppBundle\Controller;
use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Solicitud;
use AppBundle\Entity\Usuario;
use AppBundle\Entity\Parte;
use AppBundle\Form\SolicitudType;
use AppBundle\Form\UsuarioType;
use AppBundle\Form\RespuestaType;

use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="home")
     */
     public function homeAction(Request $request, AuthenticationUtils $authenticationUtils)
   {


     $mensaje = null;
     $data = array('Usuario' => null, 'Password' => null);
     $form = $this->createFormBuilder($data)
        ->add('Usuario', TextType::class)
        ->add('Password', PasswordType::class)
        ->add('Aceptar', SubmitType::class)
        ->getForm();

      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {
          $data = $form->getData();
          $username = (string) $data['Usuario'];
          $password = (string) $data['Password'];
          $ldap_dn = "uid=".$username.",ou=Users,dc=upm,dc=es";
          $ldap_password = $password;
          $ldap_con = ldap_connect("ldap.etsidi.upm.es");
          ldap_set_option($ldap_con, LDAP_OPT_PROTOCOL_VERSION, 3);

          if(ldap_bind($ldap_con,$ldap_dn,$ldap_password)) {
               $usuarioRepository=$this->getDoctrine()->getRepository(Usuario::class);
               $usuario = $usuarioRepository->findByEmail($username);
               if($usuario){
                 $session = $request->getSession();
                 $session->set('usuario', $username);
                 //$usuariosesion =$session->get('usuario');
                 return $this->render('frontal/base1.html.twig');
                 }else{
                   return $this->redirectToRoute('nuevaSolicitud');
                  }
             }
      }

         return $this->render('frontal/index.html.twig', array("form" => $form->createView()));
  }

  /**
   * @Route("/nuevaSolicitud", name="nuevaSolicitud")
   */
   public function nuevaSolicitudAction(Request $request, \Swift_Mailer $mailer)
   {
     $solicitud = new Solicitud();//Crea un Entity Usuario llamado solicitud
      //Construyendo el formulario
     $form = $this->createForm(SolicitudType::class, $solicitud);

      //Recogemos la información de un submit
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {
          $solicitud->setEstado('0');
          //Almacenar nueva Solicitud
          $em = $this->getDoctrine()->getManager();
          $em->persist($solicitud);
          $em->flush();
          $message = (new \Swift_Message('Nueva Solicitud para el servicio de Mantenimiento ETSIDI'))
            ->setFrom('mariabelen.sanz@upm.es')
            ->setTo('mariabelen.sanz@upm.es')
            ->setBody(
                 $this->renderView('Emails/NotificacionSolicitud.html.twig', ['solicitud'=>$solicitud]),'text/html')
            ;
          $mailer->send($message);
          return $this->redirectToRoute('mensaje');
          }
      return $this->render('frontal/nuevaSolicitud.html.twig',array("form" => $form->createView()));
     }


  /**
   * @Route("/mensajeNoPuede", name="mensajeNoPuede")
   */
   public function mensajeNoPuedeAction(Request $request)
   {
     return $this->render('frontal/mensajeNoPuede.html.twig');
     }


   /**
    * @Route("/mensaje", name="mensaje")
    */
    public function mensajeAction(Request $request)
    {
      return $this->render('frontal/mensaje.html.twig');
      }


  /**
  * @Route("/login", name="login")
  */
      public function loginAction(Request $request, AuthenticationUtils $authenticationUtils)
     {
           // get the login error if there is one
       $error = $authenticationUtils->getLastAuthenticationError();
           // last username entered by the user
       $lastUsername = $authenticationUtils->getLastUsername();
       return $this->render('frontal/login.html.twig', array(
              'last_username' => $lastUsername,
              'error'         => $error,
             ));
         }

     /**
      * @Route("/rellenarSatisfaccion/{id}", name="rellenarSatisfaccion")
      */
      public function rellenarSatisfaccionAction(Request $request, $id)
      {
         $parte = new Parte();
         $partesRepository = $this->getDoctrine()->getRepository(Parte::class);
         $parte=$partesRepository->find($id);
         $completado = $parte->getCompletado();
         if($completado==0){
             $form = $this->createForm(RespuestaType::class, $parte);
             $form->handleRequest($request);
             if ($form->isSubmitted() && $form->isValid()) {
             //Almacenar nuevo Parte
             $satisfaccion = $parte->getSatisfaccion();
             $observaciones = $parte->getObservaciones();

             $parte->setSatisfaccion($satisfaccion);
             $parte->setObservaciones($observaciones);
             $parte->setCompletado(1);


             $em = $this->getDoctrine()->getManager();
             $em->persist($parte);
             $em->flush();
             return $this->redirectToRoute('nuevaSolicitud');
       }
     }else{return $this->redirectToRoute('mensajeNoPuede');
      }
         return $this->render('frontal/rellenarSatisfaccion.html.twig',array("form" => $form->createView(),"parte"=>$parte));

       }

}
