<?php

namespace Neurologia\EvolucionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Neurologia\BDBundle\Entity\Evolucion as Evolucion;
use Neurologia\EvolucionBundle\Form\EvolucionType as EvolucionType;

class EvolucionController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $id_historia_clinica = $_SESSION['historia']->getId();
        //supuestamente, viene de session.
        
        $dql_1 = " SELECT e.fechaHora as fecha_evolucion, e.evolucion "
                ." FROM NeurologiaBDBundle:Evolucion e "
                ." WHERE e.historiaClinica = :id "
                ." ORDER BY e.fechaHora ASC ";
        
        $query_1 = $em->createQuery($dql_1)->setParameter('id', $id_historia_clinica);
        
        $evoluciones = $query_1->getResult();
        
        return $this->render('EvolucionBundle:Evolucion:evolucion.html.twig',
                             array(
                                 'evoluciones' => $evoluciones
                             ));
    }
    
    public function newAction(Request $request)
    {
        if (!isset($_SESSION['evolucion'])){
            throw $this->createNotFoundException('Asegurese de ingresar a esta sección por la busqueda de pacientes ');
        }
        else{
        $em = $this->getDoctrine()->getManager();
        $evolucion = $em->merge($_SESSION['evolucion']);
        $historia_clinica=$em->merge($_SESSION['historia']);
        $evolucion->setHistoriaClinica($historia_clinica);
        $evolucion->setFechaHora(new \Datetime());
        $usuario=$em->merge($_SESSION['user']);
        $evolucion->setUsuario($usuario);
        $form = $this->createForm(new EvolucionType(),$evolucion);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $_SESSION['evolucion'] = $evolucion;
            $this->guardarEvolucion();            
            $this->get('session')->getFlashBag()->add(
                        'mensaje',
                        'Se ha agregado exitosamente una evolución.'
                    );
            
           return $this->redirect($this->generateUrl('neurologia_historia_clinica_homepage'));
        }
        $vars['form']=$form->createView();
        $vars['tratinterno']=$_SESSION['tratamientos']['ti'];
        $vars['tratexterno']=$_SESSION['tratamientos']['te'];
        $vars['diagnosticos']=$_SESSION['diagnosticos'];
        $vars['estudios']=$_SESSION['estudios'];
        
       return $this->render('EvolucionBundle:Evolucion:agregar_evolucion.html.twig',$vars);
        }
    }
    
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $id_historia_clinica = $em->merge($_SESSION['historia']);
        //supuestamente, viene de session.
        
        $dql_1 = " SELECT e.fechaHora as fecha_evolucion, e.evolucion "
                ." FROM NeurologiaBDBundle:Evolucion e "
                ." WHERE e.historiaClinica = :id "
                ." ORDER BY e.fechaHora ASC ";
        
        $query_1 = $em->createQuery($dql_1)->setParameter('id', $id_historia_clinica);
        
        $evoluciones = $query_1->getResult();
        
        return $this->render('EvolucionBundle:Evolucion:evolucionList.html.twig',
                             array(
                                 'evoluciones' => $evoluciones
                             ));
    }
    
    
    function guardarEvolucion(){
        $em = $this->getDoctrine()->getManager();
        try {
    
       
               
               $em->getConnection()->beginTransaction();
       //evolucion       
               $evolucion = $em->merge($_SESSION['evolucion']);
               $em->persist($evolucion);
               $em->flush();
        //tratamientos
               if (!empty($_SESSION['tratamientos']['ti'])){
                   foreach ($_SESSION['tratamientos']['ti'] as $row) {
                       $tratamiento = $em->merge($row);
                       $tratamiento->agregarTratamientoADrogas();
                       $tratamiento->setEvolucion($evolucion);
                       $em->persist($tratamiento);
                       $em->flush();
                       $drogas=$row->getDrogaTratamiento();
                           foreach ($drogas as $value) {
                            $droga = $em->merge($value);
                            $droga->addTratamiento($tratamiento);
                            $em->persist($droga);
                            $em->flush();
                           }
                   }
                   
               }
               if (!empty($_SESSION['tratamientos']['te'])){
                   foreach ($_SESSION['tratamientos']['te'] as $row) {
                       $tratamiento = $em->merge($row);
                       $tratamiento->setEvolucion($evolucion);
                       $em->persist($tratamiento);
                       $em->flush();
                   }
                   
               }
               
        //estudios
               if (!empty($_SESSION['estudios'])){
                   foreach ($_SESSION['estudios'] as $row) {
                       $estudio = $em->merge($row);
//                       $estudio->agregarEstudioAImagenes();
                       $estudio->setEvolucion($evolucion);
                       $em->persist($estudio);
                       $em->flush();
                       $imagenes=$row->getImagenes();
                       foreach($imagenes as $value){
                            $imagen = $em->merge($value);
                            $imagen->addEstudio($estudio);
                            $em->persist($imagen);
                            $em->flush();
                           }
                       }
                   }
                   
               
        //diagnosticos
                if (!empty($_SESSION['diagnosticos'])){
                   foreach ($_SESSION['diagnosticos'] as $row) {
                       $diagnostico = $em->merge($row);
                       $diagnostico->setEvolucion($evolucion);
                       $em->persist($diagnostico);
                       $em->flush();
                   }
                   
               }
               
               $em->getConnection()->commit();
        } catch (Exception $e) {
            // Rollback the failed transaction attempt
            $em->getConnection()->rollback();
            throw $e;
        }
    }
}