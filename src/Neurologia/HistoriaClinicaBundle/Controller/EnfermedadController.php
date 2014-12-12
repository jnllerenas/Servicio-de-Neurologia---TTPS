<?php

namespace Neurologia\HistoriaClinicaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Neurologia\HistoriaClinicaBundle\Form\Formularios;
use Neurologia\BDBundle\Entity\EnfermedadActual;

class EnfermedadController extends Controller {

    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $params = array();
        $params['enfermedad'] = $em->getRepository('NeurologiaBDBundle:EnfermedadActual')->findby(array('historiaClinica' => $_SESSION['historia']->getId(),));
        $form = Formularios::createEnfermedadForm($this);
        $params['nuevaEnfermedad'] = $form->createView();
        $historia = $em->merge($_SESSION['historia']);
        $params['historia'] = $historia->getId();
        $params['paciente'] = $historia->getPaciente();
        return $this->render('NeurologiaHistoriaClinicaBundle:Enfermedad:index.html.twig', $params);
    }

    public function nuevoAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $params = array();
        $historia = $em->merge($_SESSION['historia']);
        $usuario = $em->getRepository('NeurologiaBDBundle:User')->find($_SESSION['user']->getId()); 
        $form = Formularios::nuevaEnfermedadForm($this);
        $form->handleRequest($request);
        if ($form->isValid()) {
            if ($form->get('enviar')->isClicked()) {
                //guardo los datos
                $time = new \DateTime();
                $enf = new EnfermedadActual();
                $enf->setDetalle($form->get('detalle')->getData());
                $enf->setHistoriaClinica($historia);
                $enf->setUsuario($usuario);
                $enf->setFecha($time);
                $em->persist($enf);
                $em->flush();
            }
            $historia = $em->merge($_SESSION['historia']);
            return $this->redirect($this->generateUrl('neurologia_historia_clinica_homepage', array('accion' => 'enfermedad_listar', 'tab' => 'Enfermedad')));
            
        }
        $params['enfermedad'] = $form->createView();
        $params['historia'] = $_SESSION['historia']->getId();
        return $this->render('NeurologiaHistoriaClinicaBundle:Enfermedad:add.html.twig', $params);
    }

}
