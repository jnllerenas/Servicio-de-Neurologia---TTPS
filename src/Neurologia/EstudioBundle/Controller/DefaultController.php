<?php

namespace Neurologia\EstudioBundle\Controller;

use Neurologia\BDBundle\Entity\Estudio;
use Neurologia\EstudioBundle\Form\Type\EstudioType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    public function nuevoAction(Request $request) {
        $estudio = new Estudio();
        $error = "";

        $form = $this->createForm(new EstudioType(), $estudio);

        $cloned = clone $form;

        $form->handleRequest($request);




        if ($form->isValid()) {
            // ... maybe do some form processing, like saving the Task and Tag objects

            $em = $this->getDoctrine()->getManager();
            $em->persist($estudio);
            $em->flush();
            return $this->redirect($this->generateUrl('neurologia_estudio_success'));
        }

        
        if (!($form->get('imagenes')->isEmpty())) {
            $error = $form->get('imagenes')->getErrorsAsString();
            $form = $cloned;            
        }
        



        return $this->render('NeurologiaEstudioBundle:Default:nuevo.html.twig', array(
                    'form' => $form->createView(), 'error' => $error
        ));
    }
    
        public function successAction() {


        return $this->render('NeurologiaEstudioBundle:Default:success.html.twig');
    }

}
