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
        $em = $this->getDoctrine()->getManager();
        $historia_clinica = $_SESSION['historia'];
        $evolucion = new Evolucion();
        $evolucion->setFechaHora(new \Datetime('tomorrow'));
        $evolucion->setHistoriaClinica($historia_clinica);
        
        $form = $this->createForm(new EvolucionType(),$evolucion);

        $form->handleRequest($request);

        if ($form->isValid()) {
            
            $em->persist($evolucion);
            $em->flush();
            
            $this->get('session')->getFlashBag()->add(
                        'mensaje',
                        'Se ha agregado exitósamente una evolución.'
                    );
            
            return $this->redirect($this->generateUrl('evolucion_index'));
        }
        
        return $this->render('EvolucionBundle:Evolucion:agregar_evolucion.html.twig',
                                array(
                                    'form' => $form->createView()
                                )
        );
    }
    
    public function listAction($idhistoria)
    {
        $em = $this->getDoctrine()->getManager();
        $id_historia_clinica = $em->getRepository('Neurologia\BDBundle\Entity\HistoriaClinica')->find($idhistoria);
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
    
}