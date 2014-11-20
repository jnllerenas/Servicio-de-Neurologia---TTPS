<?php

namespace Neurologia\EstudioBundle\Controller;
use Neurologia\BDBundle\Entity\Imagen;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends Controller
{
   
    public function nuevoAction(Request $request)
    {
        // create a task and give it some dummy data for this example
        $imagen = new Imagen();

        $form = $this->createFormBuilder($imagen)
            ->add('descripcion', 'text')        
             
           // ->add('estudio')
           // ->add('institucion', 'text')              
            //->add('tipoEstudio')
            ->add('file')     
            ->add('save', 'submit', array('label' => 'Crear estudio'))
            ->getForm();
        
         $form->handleRequest($request);

    if ($form->isValid()) {
        $em = $this->getDoctrine()->getManager();        
        $em->persist($imagen);
        $em->flush();

        return $this->redirect($this->generateUrl('neurologia_estudio_nuevo'));
    }

   // return array('form' => $form->createView());
    
        return $this->render('NeurologiaEstudioBundle:Default:nuevo.html.twig', array(
            'form' => $form->createView(),
        ));
    }
     
   
    

}

    

