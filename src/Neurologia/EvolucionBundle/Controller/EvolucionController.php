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
        $evolucion = new Evolucion();
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
        $vars['drogastratamiento']=$_SESSION['tratamientos']['d'];
        $vars['tratexterno']=$_SESSION['tratamientos']['te'];
        //$vars['diagnosticos']=array();
        //$vars['estudios']=array();
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
               if (!empty($_SESSION['tratamientos']['t'])){
                   foreach ($_SESSION['tratamientos']['t'] as $key=>$row) {
                       $tratamiento = $em->merge($row);
                       $tratamiento->setEvolucion($evolucion);
                       $em->persist($tratamiento);
                       $em->flush();
                       if (array_key_exists($key, $_SESSION['tratamientos']['d'])) {
                            $droga = $em->merge($_SESSION['tratamientos']['d'][$key]);
                            $droga->setTratamiento($tratamiento);
                            $em->persist($tratamiento);
                            $em->flush();
                       }
                   }
                   
               }
               
        //estudios
        //diagnosticos
               
               
               $em->getConnection()->commit();
        } catch (Exception $e) {
            // Rollback the failed transaction attempt
            $em->getConnection()->rollback();
            throw $e;
        }
    }
}