<?php

namespace Neurologia\DiagnosticoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Neurologia\BDBundle\Entity\DiagnosticoPresuntivo;
use Neurologia\BDBundle\Entity\DiagnosticoDefinitivo;

class DefaultController extends Controller
{
    public function indexAction($error=null, $msj=null)
    {
		$datos=$this->getDoctrine()->getRepository('NeurologiaBDBundle:DiagnosticoPresuntivo')->findAll();
		//$datosB=$this->getDoctrine()->getRepository('NeurologiaBDBundle:DiagnosticoDefinitivo')->findAll();
        
		/*REVISAR*/
		$em = $this->getDoctrine()->getManager();
		$historia=$em->merge($_SESSION['historia']);
		$query = $em->createQuery(
			'SELECT p, c FROM NeurologiaBDBundle:DiagnosticoDefinitivo p
            INNER JOIN p.categoriaDiagnostico c WITH p.categoriaDiagnostico=c INNER JOIN NeurologiaBDBundle:Evolucion e WITH p.evolucion = e WHERE e.historiaClinica = :historia'
		)->setParameter('historia',$historia);

		$datosB = $query->getResult();
		//var_dump($datosB);
		
		return $this->render('NeurologiaDiagnosticoBundle:Default:index.html.twig',
			array(	'datos'=>$datos, 
					'datosB'=>$datosB,
					'msj'=>$msj,
					'error'=>$error)
		);
    }    
	
	public function newAction()
    {	

		$request = $this->getRequest();
		
		if($request->getMethod() == 'POST'){
		
			/*print_r($request->request->all());
			die();*/
		
			$descripcion = $request->request->get('descripcion');	//ACCEDE AL POST TOMANDO EN CUENTA EL NAME DEL ELEMENTO HTML
			
			$evolucion_id = 1;	//REEMPLAZAR EL '1' POR VALOR DE LA SESSION O VER COMO
			$evolucion = $this->getDoctrine()->getRepository('NeurologiaBDBundle:Evolucion')->find($evolucion_id);
			
			if (!$evolucion) {
				throw $this->createNotFoundException('No Existe la evolucion con identificador: '.$evolucion_id);
			}

			/*var_dump($evolucion);die;*/
			
			$tipo = $request->request->get('tipo');
			$categoria_diagnostico_id = $request->request->get('select_diagnostico_categoria');
			$categoria_diagnostico = $this->getDoctrine()->getRepository('NeurologiaBDBundle:CategoriaDiagnostico')->find($categoria_diagnostico_id);
			$fecha = new \DateTime("now");
			
			if (!$evolucion) {
				throw $this->createNotFoundException('No Existe la evolucion con identificador: '.$evolucion_id);
			}
			
			switch ($tipo) {
				case 'Presuntivo':
					$entity = new DiagnosticoPresuntivo();
					
					$entity->setDescripcion($descripcion);
					$entity->setEvolucion($evolucion);
					$entity->setFecha($fecha);
										
					$em = $this->getDoctrine()->getManager();
					$em->persist($entity);
					$em->flush();

					break;
				case 'Definitivo':
					$entity = new DiagnosticoDefinitivo();
					
					$entity->setDescripcion($descripcion);
					$entity->setEvolucion($evolucion);
					$entity->setCategoriaDiagnostico($categoria_diagnostico);
					$entity->setFecha($fecha);
					
					$em = $this->getDoctrine()->getManager();
					$em->persist($entity);
					$em->flush();
					
					break;
			}

			return $this->forward('NeurologiaDiagnosticoBundle:Default:index', array('msj'=>'Diagnostico agregado'));
		}
		
		$categorias = $this->getDoctrine()->getRepository('NeurologiaBDBundle:CategoriaDiagnostico')->findAll();
					
	    return $this->render('NeurologiaDiagnosticoBundle:Default:new.html.twig', array('categorias'=>$categorias)); 
			
    }

}
