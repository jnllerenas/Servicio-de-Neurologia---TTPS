<?php

namespace Neurologia\HistoriaClinicaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Neurologia\HistoriaClinicaBundle\Form\Formularios;
use Neurologia\BDBundle\Entity\Motivo;

class MotivoController extends Controller
{
    public function indexAction()
    {
       $historiaid=$_SESSION['historia']->getId();
       $em = $this->getDoctrine()->getManager();
       $params = array();
       $params['motivo'] = $em->getRepository('NeurologiaBDBundle:Motivo')->findby(
               array(
		'historiaClinica' => $historiaid,
		 ));
        if (!$params['motivo']) {
            throw $this->createNotFoundException('Unable to find Motivo for Historia ');
        }
       $form = Formularios::createMotivoForm($this, $historiaid);
       $params['nuevoMotivo'] = $form->createView();
       $historia = $em->merge($_SESSION['historia']);
       $params['historiaId'] = $historia->getId();
       $params['paciente'] = $historia->getPaciente();
       return $this->render('NeurologiaHistoriaClinicaBundle:Motivo:index.html.twig', $params);
       
    }
    
    public function nuevoAction(Request $request) {
        
        $em = $this->getDoctrine()->getManager();
        $params = array();
        $historia = $em->merge($_SESSION['historia']);
        $usuario = $em->merge($_SESSION['user']);
        $form = Formularios::nuevoMotivoForm($this);
        $form->handleRequest($request);
        if ($form->isValid()) {
           if( $form->get('enviar')->isClicked()){
              //guardo los datos
              $time = new \DateTime();
              $motivo = new Motivo();
              $motivo->setDetalle($form->get('detalle')->getData());
              $motivo->setHistoriaClinica($historia);
              $motivo->setUsuario($usuario);
              $motivo->setFecha($time);
             
                  $em->persist($motivo);
                  $em->flush();
             
              
           }
           $historia = $em->merge($_SESSION['historia']);
            return $this->redirect($this->generateUrl('neurologia_historia_clinica_homepage', array('solapa' =>'Motivo')));
        }
        $params['motivo'] = $form->createView();
        $params['historia'] = $_SESSION['historia']->getId();
        return $this->render('NeurologiaHistoriaClinicaBundle:Motivo:add.html.twig', $params);
    }
    
    
}
