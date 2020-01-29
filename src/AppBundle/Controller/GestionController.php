<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Solicitud;
use AppBundle\Entity\Task;
use AppBundle\Entity\Usuario;
use AppBundle\Entity\Parte;
use AppBundle\Form\ParteType;
use AppBundle\Form\SolicitudType;
use AppBundle\Form\UsuarioType;
use AppBundle\Form\FechaType;
use AppBundle\Form\TaskType;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


      /**
       * @Route("/gestionMantenimiento")
       */

class GestionController extends Controller
{
    /**
     * @Route("/registro", name="registro")
     */
     public function registroAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
     {
        $usuario = new Usuario();//Crea un Entity Usuario llamado usuario
        //Construyendo el formulario
        $form = $this->createForm(UsuarioType::class, $usuario);

        //Recogemos la información de un submit
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
          // Rellenar el Entity Usuario
          $password = $passwordEncoder->encodePassword($usuario, $usuario->getPlainPassword());
          $usuario->setPassword($password);
          // 3b) $username=$email
          $usuario->setUsername($usuario->getEmail());

          //3c) $roles
          $usuario->setRoles(array('ROLE_USER'));

          //Almacenar nuevo Usuario
          $em = $this->getDoctrine()->getManager();
          $em->persist($usuario);
          $em->flush();
          return $this->redirectToRoute('registro');
      }
        return $this->render('gestionMantenimiento/registroUsuario.html.twig',array("form" => $form->createView()));
      }

      /**
       * @Route("/nuevoParte/{id}", name="nuevoParte")
       */
       public function nuevoParteAction(Request $request,$id)
       {

            $parte = new Parte();
            $form = $this->createForm(ParteType::class, $parte);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
            $parte = $form->getData();
            $solicitud = new Solicitud();
            $solicitudRepository = $this->getDoctrine()->getRepository(Solicitud::class);
            $solicitud = $solicitudRepository->find($id);
            $solicitud->setPendiente('0');

            $em = $this->getDoctrine()->getManager();
            $em->persist($solicitud);
            $em->flush();

            $parte->setSolicitud($solicitud);
            $em = $this->getDoctrine()->getManager();
            $em->persist($parte);
            $em->flush();
            return $this->redirectToRoute('partes');

       }
        return $this->render('gestionMantenimiento/nuevoParte.html.twig',array("form" => $form->createView()));
        }

        /**
         * @Route("/editarParte/{id}", name="editarParte")
         */
         public function editrParteAction(Request $request,$id)
         {

            $partesRepository = $this->getDoctrine()->getRepository(Parte::class);
            $parte=$partesRepository->find($id);

            $form = $this->createForm(ParteType::class, $parte);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
              //Almacenar nuevo Parte

            $em = $this->getDoctrine()->getManager();
            $em->persist($parte);
            $em->flush();
            return $this->redirectToRoute('partes');
         }
            return $this->render('gestionMantenimiento/nuevoParte.html.twig',array("form" => $form->createView()));

          }

    /**
     * @Route("/pendientes", name="pendientes")
     */
    public function pendientesAction(Request $request)
    {
       $repository = $this->getDoctrine()->getRepository(Solicitud::class);
       $solicitudes = $repository->findByPendiente('1');
       return $this->render('gestionMantenimiento/pendientes.html.twig',array("solicitudes" => $solicitudes));
      }

    /**
     * @Route("/solicitudes", name="solicitudes")
     */
    public function solicitudesAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Solicitud::class);
        $solicitudes = $repository->findAll();
        return $this->render('gestionMantenimiento/pendientes.html.twig',array("solicitudes" => $solicitudes));
        }

    /**
     * @Route("/partes", name="partes")
     */
    public function partesAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Parte::class);
        $partes = $repository->findAll();
        return $this->render('gestionMantenimiento/partes.html.twig',array("partes" => $partes));
        }

    /**
     * @Route("/seleccionaPartes", name="seleccionaPartes")
     */
    public function seleccionaPartesAction(Request $request)
    {
      $data = array('desde' => null, 'hasta' => null);
      $form = $this->createFormBuilder($data)
      ->add('desde', DateType::class, array('label' => 'Desde'))
      ->add('hasta', DateType::class, array('label' => 'Hasta'))
      ->add('Aceptar', SubmitType::class, array('label' => 'Aceptar'))
      ->getForm();

       $form->handleRequest($request);
       if ($form->isSubmitted() && $form->isValid()) {
           $data = $form->getData();
           $desde = $data['desde'];
           $hasta = $data['hasta'];

           $repository = $this->getDoctrine()->getRepository(Parte::class);
           $entityManager = $this->getDoctrine()->getManager();

           $query = $entityManager->createQuery(
                'SELECT p
                FROM AppBundle:Parte p
                WHERE (( p.fechainicio >= :desde ) AND (p.fechainicio <= :hasta ))
                ORDER BY p.fechainicio ASC'
            )->setParameters(array('desde' => $desde, 'hasta' => $hasta));


      $partes = $query->getResult();
      return $this->render('gestionMantenimiento/partes.html.twig',array("partes" => $partes));
      }
      return $this->render('gestionMantenimiento/seleccionaPartes.html.twig',array("form" => $form->createView()));
      }

        /**
         * @Route("/parte/{id}", name="parte")
         */
        public function parteAction(Request $request,$id=null)
        {
          if($id!=null){
            //Capturar el repositorio de la Tabla contra la DB
            $parteRepository = $this->getDoctrine()->getRepository(Parte::class);
            $partes = $parteRepository->findAll();
            $parte = $parteRepository->find($id);
            return $this->render('gestionMantenimiento/parte.html.twig',array("parte"=>$parte));
          }else{
            return $this->redirectToRoute('seleccionaPartes');
          }
          }

          /**
         * @Route("/solicitud/{id}", name="solicitud")
         */
        public function solicitudAction(Request $request,$id=null)
        {
          if($id!=null){
            //Capturar el repositorio de la Tabla contra la DB
            $solicitudRepository = $this->getDoctrine()->getRepository(Solicitud::class);
            $solicitudes = $solicitudRepository->findAll();
            $solicitud = $solicitudRepository->find($id);
            return $this->render('gestionMantenimiento/solicitud.html.twig',array("solicitud"=>$solicitud));
          }else{
            return $this->redirectToRoute('solicitudes');
          }
          }

      /**
     * @Route("/borrar/{id}", name="borrarParte")
     */
    public function borrarParteAction(Request $request,$id=null)
    {
      if($id)
      {
        $solicitud = new Solicitud();
        //Búsqueda del parte
        $repository = $this->getDoctrine()->getRepository(Parte::class);
        $parte = $repository->find($id);
        $solicitud = $parte->getSolicitud();
        $solicitudId = $solicitud->getId();
        $solicitudRepository = $this->getDoctrine()->getRepository(Solicitud::class);
        $solicitud = $solicitudRepository->find($solicitudId);
        $solicitud->setPendiente('1');
        //Borrado
        $em = $this->getDoctrine()->getManager();
        $em->remove($parte);
        $em->flush();
        $em = $this->getDoctrine()->getManager();
        $em->persist($solicitud);
        $em->flush();

      }
      return $this->redirectToRoute('partes');
    }



  }
