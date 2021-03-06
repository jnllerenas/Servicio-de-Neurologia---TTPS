<?php

namespace Neurologia\TratamientoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Neurologia\BDBundle\Entity\Evolucion;
use Neurologia\BDBundle\Entity\Droga;
use Neurologia\BDBundle\Entity\EfectoAdverso;
use Neurologia\BDBundle\Entity\DrogaTratamiento;
use Neurologia\BDBundle\Entity\TratamientoInterno as TratamientoInterno;
use Neurologia\TratamientoBundle\Form\TratamientoInternoType;
use Neurologia\TratamientoBundle\Form\DrogaTratamientoType;
use Symfony\Component\HttpFoundation\Request;

class TratamientoInternoController extends Controller {

    public function indexAction() {
        return $this->render('TratamientoBundle:Tratamiento:errorDeAcceso.html.twig');
    }
	
	public function showAction() {
        $id = $_GET['id'];
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('NeurologiaBDBundle:TratamientoInterno')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find tratamiento Interno entity.');
        }
		$drogas = $em->getRepository('NeurologiaBDBundle:DrogaTratamiento')->findBy(
																				array('tratamiento' => $id)
		
																	);
																	
		$dql_1 = " SELECT d.descripcion as drogadescripcion, dt.dosis, ea.descripcion as efectodescripcion"
                ." FROM NeurologiaBDBundle:DrogaTratamiento dt "
                ." INNER JOIN NeurologiaBDBundle:Droga d WITH dt.droga = d "
                . "LEFT JOIN NeurologiaBDBundle:EfectoAdverso ea WITH dt.efectoAdverso = ea"
                ." WHERE dt.tratamiento = :id ";
		$query_1 = $em->createQuery($dql_1)->setParameter('id', $id);
        $drogas = $query_1->getResult();
		
        return $this->render('TratamientoBundle:Tratamiento:show.html.twig', array('tratamiento' => $entity, 'drogas' => $drogas));
    }

    public function newAction(Request $request) {
        
//        $medicamentos = $em->getRepository('Neurologia\BDBundle\Entity\Droga')->findAll();
//        $efectos_adversos = $em->getRepository('Neurologia\BDBundle\Entity\EfectoAdverso')->findAll();
//        $evolucion = $_SESSION['evolucion'][0];
//
        $tratamientoInterno = new TratamientoInterno();
//        $tratamientoInterno->setEvolucion($evolucion);
//        $tratamientoInterno->setInicio(new \Datetime());
//        
//        $droga_tratamiento = new DrogaTratamiento();
//        $droga_tratamiento->setTratamiento($tratamientoInterno);


        $form = $this->createForm(new TratamientoInternoType(), $tratamientoInterno);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $evolucion = $em->merge($_SESSION['evolucion'][0]);
            $tratamientoInterno->agregarTratamientoADrogas();
            $tratamientoInterno->setEvolucion($evolucion);
            $em->persist($tratamientoInterno);
            $em->flush();
            return $this->redirect($this->generateUrl('neurologia_historia_clinica_homepage', array('accion' => 'evolucion_modificar', 'id' => $evolucion->getId(), 'tab' => 'Evolucion')));
        }
        return $this->render('TratamientoBundle:Tratamiento:tratamientoInterno.html.twig', array('form' => $form->createView(),)
        );
    }

    public function editAction(Request $request, $key) {
        if (array_key_exists($key, $_SESSION['tratamientos']['ti'])) {
            $em = $this->getDoctrine()->getManager();
            $tratamientoInterno = $em->merge($_SESSION['tratamientos']['ti'][$key]);
            foreach ($tratamientoInterno->getDrogaTratamiento() as $value) {
                $tratamientoInterno->removeDrogaTratamiento($value);
                $tratamientoInterno->addDrogaTratamiento($em->merge($value));
            }
            $form = $this->createForm(new TratamientoInternoType(), $tratamientoInterno);

            $form->handleRequest($request);

            if ($form->isValid()) {
                $_SESSION['tratamientos']['ti'][$key] = $tratamientoInterno;
            //    return $this->redirect($this->generateUrl('evolucion_nuevo'));
            }
            return $this->render('TratamientoBundle:Tratamiento:TIedit.html.twig', array(
                        'form' => $form->createView(),
                        'key' => $key
            ));
        } else {
       //     return $this->redirect($this->generateUrl('evolucion_nuevo'));
        }
    }

    public function deleteAction($key) {
        if (array_key_exists($key, $_SESSION['tratamientos']['ti'])) {
            unset($_SESSION['tratamientos']['ti'][$key]);
        }
     //   return $this->redirect($this->generateUrl('evolucion_nuevo'));
    }

}
