<?php

namespace Neurologia\TratamientoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Neurologia\BDBundle\Entity\Droga;
use Neurologia\BDBundle\Entity\EfectoAdverso;
use Neurologia\BDBundle\Entity\DrogaTratamiento;
use Neurologia\BDBundle\Entity\TratamientoInterno as TratamientoInterno;
use Neurologia\TratamientoBundle\Form\TratamientoInternoType;
use Neurologia\TratamientoBundle\Form\DrogaTratamientoType;
use Symfony\Component\HttpFoundation\Request;

class TratamientoInternoController extends Controller
{
    
    public function indexAction()
    {
        return $this->render('TratamientoBundle:Tratamiento:errorDeAcceso.html.twig');
    }
    
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

//        $medicamentos = $em->getRepository('Neurologia\BDBundle\Entity\Droga')->findAll();
//        $efectos_adversos = $em->getRepository('Neurologia\BDBundle\Entity\EfectoAdverso')->findAll();
//        $evolucion = $em->getRepository('Neurologia\BDBundle\Entity\Evolucion')->find(1);
     
        $tratamientoInterno = new TratamientoInterno();
//        $tratamientoInterno->setEvolucion($evolucion);
//        $tratamientoInterno->setInicio(new \Datetime());
//        
//        $droga_tratamiento = new DrogaTratamiento();
//        $droga_tratamiento->setTratamiento($tratamientoInterno);
        
        
        $form = $this->createForm(new TratamientoInternoType(), $tratamientoInterno);
        
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            
//            $em->persist($tratamientoInterno);
//            $em->flush();
            $_SESSION['tratamientos']['ti'][]= $tratamientoInterno;
            
            return $this->redirect($this->generateUrl('evolucion_homepage_agregar'));
            
        }
        
        return $this->render('TratamientoBundle:Tratamiento:tratamientoInterno.html.twig',
                                array(
                                    'form' => $form->createView(),
                                )
        );
    }
    
    public function editAction(Request $request,$key)
    {
        if(array_key_exists($key, $_SESSION['tratamientos']['ti'])){
            $em = $this->getDoctrine()->getManager();
            $tratamientoInterno = $em->merge($_SESSION['tratamientos']['ti'][$key]);
            foreach ($tratamientoInterno->getDrogaTratamiento() as $value){
                $tratamientoInterno->removeDrogaTratamiento($value);
                $tratamientoInterno->addDrogaTratamiento($em->merge($value));
            }
            $form = $this->createForm(new TratamientoInternoType(), $tratamientoInterno);

            $form->handleRequest($request);

            if ($form->isValid()) {
                $_SESSION['tratamientos']['ti'][$key]= $tratamientoInterno;
                return $this->redirect($this->generateUrl('evolucion_homepage_agregar'));
            }
            return $this->render('TratamientoBundle:Tratamiento:TIedit.html.twig',
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
        if(array_key_exists($key, $_SESSION['tratamientos']['ti'])){
            unset($_SESSION['tratamientos']['ti'][$key]);
        }
        return $this->redirect($this->generateUrl('evolucion_homepage_agregar'));
    }
}
