<?php

namespace Neurologia\TratamientoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Neurologia\BDBundle\Entity\TratamientoExterno;
use Neurologia\TratamientoBundle\Form\TratamientoExternoType;
use Neurologia\BDBundle\Entity\Evolucion as Evolucion;
use Symfony\Component\HttpFoundation\Request;

class TratamientoExternoController extends Controller
{
    
    public function indexAction()
    {
        return $this->render('TratamientoBundle:Tratamiento:errorDeAcceso.html.twig');
    }
    
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
//        $evolucion = $em->getRepository('Neurologia\BDBundle\Entity\Evolucion')->find(1);
        
        $tratamientoExterno = new TratamientoExterno();
//        $tratamientoExterno->setEvolucion($evolucion);
        
        $form = $this->createForm(new TratamientoExternoType(),$tratamientoExterno);

        $form->handleRequest($request);

        if ($form->isValid()) {
            
            $_SESSION['tratamientos']['te'][] = $tratamientoExterno;
            
            $this->get('session')->getFlashBag()->add(
                        'mensaje',
                        'Se ha agregado exitósamente un diagnóstico externo.'
                    );
            
            return $this->redirect($this->generateUrl('evolucion_homepage_agregar'));
        }
        
        return $this->render('TratamientoBundle:Tratamiento:tratamientoExterno.html.twig',
                                array(
                                    'form' => $form->createView()
                                )
        );
    }
    
    public function editAction(Request $request,$key)
    {
        if(array_key_exists($key, $_SESSION['tratamientos']['te'])){
            $em = $this->getDoctrine()->getManager();
            $tratamientoExterno = $em->merge($_SESSION['tratamientos']['te'][$key]);
            
            $form = $this->createForm(new TratamientoExternoType(), $tratamientoExterno);

            $form->handleRequest($request);

            if ($form->isValid()) {
                $_SESSION['tratamientos']['te'][$key]= $tratamientoExterno;
                return $this->redirect($this->generateUrl('evolucion_homepage_agregar'));
            }
            return $this->render('TratamientoBundle:Tratamiento:TEedit.html.twig',
                    array(
                                    'form' => $form->createView(),
                                    'key' => $key
                                ));
        }else{
            return $this->redirect($this->generateUrl('evolucion_homepage_agregar'));
        }
    }
    
    public function deleteAction($key)
    {
         if(array_key_exists($key, $_SESSION['tratamientos']['te'])){
            unset($_SESSION['tratamientos']['te'][$key]);
        }
        return $this->redirect($this->generateUrl('evolucion_homepage_agregar'));
    }
    
}
