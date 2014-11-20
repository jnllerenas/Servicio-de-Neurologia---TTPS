<?php

namespace Neurologia\PacientesBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Neurologia\BDBundle\Entity\Paciente;
use Neurologia\PacientesBundle\Form\Type\PacienteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    public function agregarAction(Request $request) {
        
        $paciente = new Paciente();

        $form = $this->createForm(new PacienteType(), $paciente);

        $form->handleRequest($request);

        if ($form->isValid()) {
        $em = $this->getDoctrine()->getManager();        
        $em->persist($paciente);
        $em->flush();

        return $this->redirect($this->generateUrl('neurologia_paciente_agregar'));
    }

        return $this->render('NeurologiaPacientesBundle:Default:agregar.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

}
