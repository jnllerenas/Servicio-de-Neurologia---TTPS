<?php

namespace Neurologia\HistoriaClinicaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Neurologia\HistoriaClinicaBundle\Form\Formularios;
use Neurologia\BDBundle\Entity\EnfermedadActual;

class EnfermedadController extends Controller
{
     public function indexAction($id)
    {
       $em = $this->getDoctrine()->getManager();
       $params = array();
       $params['enfermedad'] = $em->getRepository('NeurologiaBDBundle:EnfermedadActual')->findby(
               array(
		'historiaClinica' => $id,
		 ));
       $form = Formularios::createEnfermedadForm($this, $id);
       $params['nuevaEnfermedad'] = $form->createView();
       $historia = $em->getRepository('NeurologiaBDBundle:HistoriaClinica')->find($id);
       $params['historia'] = $historia->getId();
       $params['paciente'] = $historia->getPaciente();
       return $this->render('NeurologiaHistoriaClinicaBundle:Enfermedad:index.html.twig', $params);
    }
    
    public function nuevoAction(Request $request, $id) {
        
        $em = $this->getDoctrine()->getManager();
        $params = array();
        $historia = $em->getRepository('NeurologiaBDBundle:HistoriaClinica')->find($id);
        $form = Formularios::nuevaEnfermedadForm($this,$id);
        $form->handleRequest($request);
        if ($form->isValid()) {
           if( $form->get('enviar')->isClicked()){
              //guardo los datos
               $time = new \DateTime();
              $enf = new EnfermedadActual();
              $enf->setDetalle($form->get('detalle')->getData());
              $enf->setHistoriaClinica($historia);
              $enf->setFecha($time);
              $em->persist($enf);
              $em->flush();
           }
           $historia = $em->getRepository('NeurologiaBDBundle:HistoriaClinica')->find($id);
           return $this->redirect($this->generateUrl('neurologia_historia_clinica_homepage', array('idpaciente' => $historia->getPaciente()->getId(),'solapa' =>'Enfermedad'))); 
        }
        $params['enfermedad'] = $form->createView();
        $params['historia'] = $id;
        return $this->render('NeurologiaHistoriaClinicaBundle:Enfermedad:add.html.twig', $params);
    }
    
    
    
}
