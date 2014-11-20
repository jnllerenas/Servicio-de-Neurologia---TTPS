<?php

namespace Neurologia\EstudioBundle\Controller;
use Neurologia\BDBundle\Entity\Estudio;
use Neurologia\EstudioBundle\Form\Type\EstudioType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends Controller
{
        public function nuevoAction(Request $request)
    {
        $estudio = new Estudio();

        $form = $this->createForm(new EstudioType(), $estudio);

        $form->handleRequest($request);

        if ($form->isValid()) {
            // ... maybe do some form processing, like saving the Task and Tag objects
            
        $em = $this->getDoctrine()->getManager();        
        $em->persist($estudio);
        $em->flush();

            return $this->redirect($this->generateUrl('neurologia_estudio_nuevo'));
        }

        return $this->render('NeurologiaEstudioBundle:Default:nuevo.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
}

    

