<?php

namespace Neurologia\TratamientoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TratamientoController extends Controller
{
    
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        //supuestamente, viene de session.
        $id_historia_clinica = 1;
        
        $dql_1 = " SELECT e.fechaHora as fecha_tratamiento, te.descripcion as descripcion "
                //. "       SIZE(collection) as con_medicamentos, count(ti.id) as con_efectos_adversos "
                ." FROM NeurologiaBDBundle:Evolucion e "
                ."    LEFT JOIN NeurologiaBDBundle:TratamientoExterno te WITH te.evolucion = e.id "
                ."    LEFT JOIN NeurologiaBDBundle:TratamientoInterno ti WITH ti.evolucion = e.id "
                ." WHERE (ti.evolucion IS NOT NULL OR te.evolucion IS NOT NULL) "
                ."   AND e.historiaClinica = :id "
                ." ORDER BY e.fechaHora ASC ";
        
        $query_1 = $em->createQuery($dql_1)->setParameter('id', $id_historia_clinica);
        
        $tratamientos = $query_1->getResult();
        
        return $this->render('TratamientoBundle:Tratamiento:tratamiento.html.twig',
                             array(
                                 'tratamientos' => $tratamientos
                             ));
    }
    
}
