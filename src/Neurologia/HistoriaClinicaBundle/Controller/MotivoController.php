<?php

namespace Neurologia\HistoriaClinicaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Neurologia\HistoriaClinicaBundle\Form\Formularios;
use Neurologia\BDBundle\Entity\Motivo;

class MotivoController extends Controller
{
    public function indexAction($id)
    {
        
       $em = $this->getDoctrine()->getManager();
       $params = array();
       $params['motivo'] = $em->getRepository('NeurologiaBDBundle:Motivo')->findby(
               array(
		'historiaClinica' => $id,
		 ));
        if (!$params['motivo']) {
            throw $this->createNotFoundException('Unable to find Motivo for Historia ');
        }
       $form = Formularios::createMotivoForm($this, $id);
       $params['nuevoMotivo'] = $form->createView();
       $historia = $em->getRepository('NeurologiaBDBundle:HistoriaClinica')->find($id);
       $params['historiaId'] = $historia->getId();
       $params['paciente'] = $historia->getPaciente();
       return $this->render('NeurologiaHistoriaClinicaBundle:Motivo:index.html.twig', $params);
       
    }
    
    public function nuevoAction(Request $request, $id) {
        
        $em = $this->getDoctrine()->getManager();
        $params = array();
        $historia = $em->getRepository('NeurologiaBDBundle:HistoriaClinica')->find($id);
        $form = Formularios::nuevoMotivoForm($this,$id);
        $form->handleRequest($request);
        if ($form->isValid()) {
           if( $form->get('enviar')->isClicked()){
              //guardo los datos
              $time = new \DateTime();
              $motivo = new Motivo();
              $motivo->setDetalle($form->get('detalle')->getData());
              $motivo->setHistoriaClinica($historia);
              $motivo->setFecha($time);
             
                  $em->persist($motivo);
                  $em->flush();
             
              
           }
           $historia = $em->getRepository('NeurologiaBDBundle:HistoriaClinica')->find($id);
            return $this->redirect($this->generateUrl('neurologia_historia_clinica_homepage', array('idpaciente' => $historia->getPaciente()->getId(),'solapa' =>'Motivo:index')));
        }
        $params['motivo'] = $form->createView();
        $params['historia'] = $id;
        return $this->render('NeurologiaHistoriaClinicaBundle:Motivo:add.html.twig', $params);
    }
    
    
}
