<?php

namespace Neurologia\TratamientoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Neurologia\BDBundle\Entity\Droga;
use Neurologia\BDBundle\Entity\EfectoAdverso;
use Neurologia\BDBundle\Entity\DrogaTratamiento;
use Neurologia\BDBundle\Entity\TratamientoInterno as TratamientoInterno;
use Neurologia\BDBundle\Entity\Evolucion as Evolucion;
use Neurologia\TratamientoBundle\Form\TratamientoInternoType;
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

        $medicamentos = $em->getRepository('Neurologia\BDBundle\Entity\Droga')->findAll();
        $efectos_adversos = $em->getRepository('Neurologia\BDBundle\Entity\EfectoAdverso')->findAll();
        $evolucion = $em->getRepository('Neurologia\BDBundle\Entity\Evolucion')->find(1);

        $tratamientoInterno = new TratamientoInterno();
        $tratamientoInterno->setEvolucion($evolucion);
        $tratamientoInterno->setInicio(new \Datetime('tomorrow'));
        $tratamientoInterno->setActivo(true);
        
        $form = $this->createForm(new TratamientoInternoType(),$tratamientoInterno);

        $form->handleRequest($request);

        if ($form->isValid()) {
            
            //$data = $form->getData();
            //var_dump('falta terminar esto');
            //var_dump($this->get('request')->request->get('neurologia_bdbundle_tratamientointerno[select_efectos_adversos_1]'));
            $em->persist($tratamientoInterno);
            $em->flush();
            
            return $this->redirect($this->generateUrl('tratamiento_index'));
            
        }
        
        return $this->render('TratamientoBundle:Tratamiento:tratamientoInterno.html.twig',
                                array(
                                    'form' => $form->createView(),
                                    'medicamentos' => $medicamentos,
                                    'efectos_adversos' => $efectos_adversos
                                )
        );
    }
    
    public function editAction()
    {
        return $this->render('TratamientoBundle:Tratamiento:tratamientoInterno.html.twig');
    }
    
}