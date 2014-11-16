<?php

namespace Neurologia\HistoriaClinicaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Neurologia\HistoriaClinicaBundle\Form\Formularios;
use Neurologia\DBBundle\Entity\EnfermedadActual;

class EnfermedadController extends Controller
{
     public function indexAction($id)
    {
       $em = $this->getDoctrine()->getManager();
       $params = array();
       $params['enfermedad'] = $em->getRepository('NeurologiaDBBundle:EnfermedadActual')->findby(
               array(
		'historiaClinica' => $id,
		 ));
       $form = Formularios::createEnfermedadForm($this, $id);
       $params['nuevaEnfermedad'] = $form->createView();
       return $this->render('NeurologiaHistoriaClinicaBundle:Enfermedad:index.html.twig', $params);
    }
    
    public function nuevoAction(Request $request, $id) {
        
        $em = $this->getDoctrine()->getManager();
        $params = array();
        $historia = $em->getRepository('NeurologiaDBBundle:HistoriaClinica')->find($id);
        $form = Formularios::nuevaEnfermedadForm($this,$id);
        $form->handleRequest($request);
        if ($form->isValid()) {
           if( $form->get('enviar')->isClicked()){
              //guardo los datos
              $enf = new EnfermedadActual();
              $enf->setDetalle($form->get('detalle')->getData());
              $enf->setHistoriaClinica($historia);
              $em->persist($enf);
              $em->flush();
           }
            return $this->redirect($this->generateUrl('neurologia_historia_clinica_enfermedad', array('id' => $id)));
        }
        $params['enfermedad'] = $form->createView();
        return $this->render('NeurologiaHistoriaClinicaBundle:Enfermedad:add.html.twig', $params);
    }
    
    
    
}
