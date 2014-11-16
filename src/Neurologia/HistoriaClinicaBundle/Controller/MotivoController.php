<?php

namespace Neurologia\HistoriaClinicaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Neurologia\HistoriaClinicaBundle\Form\Formularios;
use Neurologia\DBBundle\Entity\Motivo;

class MotivoController extends Controller
{
    public function indexAction($id)
    {
       $em = $this->getDoctrine()->getManager();
       $params = array();
       $params['motivo'] = $em->getRepository('NeurologiaDBBundle:Motivo')->findby(
               array(
		'historiaClinica' => $id,
		 ));
       $form = Formularios::createMotivoForm($this, $id);
       $params['nuevoMotivo'] = $form->createView();
       return $this->render('NeurologiaHistoriaClinicaBundle:Motivo:index.html.twig', $params);
    }
    
    public function nuevoAction(Request $request, $id) {
        
        $em = $this->getDoctrine()->getManager();
        $params = array();
        $historia = $em->getRepository('NeurologiaDBBundle:HistoriaClinica')->find($id);
        $form = Formularios::nuevoMotivoForm($this,$id);
        $form->handleRequest($request);
        if ($form->isValid()) {
           if( $form->get('enviar')->isClicked()){
              //guardo los datos
              $motivo = new Motivo();
              $motivo->setDetalle($form->get('detalle')->getData());
              $motivo->setHistoriaClinica($historia);
              $em->persist($motivo);
              $em->flush();
           }
            return $this->redirect($this->generateUrl('neurologia_historia_clinica_motivo', array('id' => $id)));
        }
        $params['motivo'] = $form->createView();
        return $this->render('NeurologiaHistoriaClinicaBundle:Motivo:add.html.twig', $params);
    }
    
    
    
}
