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
        $id_historia_clinica = $_SESSION['historia']->getId();
        
        $dql_1 = " SELECT ti.descripcion as descripcion, ti.activo, ti.inicio, COUNT(dt.droga) AS drogas "
                ." FROM NeurologiaBDBundle:Evolucion e "
                ." INNER JOIN NeurologiaBDBundle:TratamientoInterno ti WITH ti.evolucion = e "
                . "LEFT JOIN NeurologiaBDBundle:DrogaTratamiento dt WITH dt.tratamiento = ti"
                ." WHERE e.historiaClinica = :id "
                . "GROUP BY ti.id"
                ." ORDER BY e.fechaHora ASC ";
        
        $dql_2 = "SELECT te.descripcion as descripcion  "
                . "FROM NeurologiaBDBundle:Evolucion e "
                ." INNER JOIN NeurologiaBDBundle:TratamientoExterno te WITH te.evolucion = e "
                ." WHERE e.historiaClinica = :id "
                . " ORDER BY e.fechaHora ASC ";
        
        $query_1 = $em->createQuery($dql_1)->setParameter('id', $id_historia_clinica);
        $query_2 = $em->createQuery($dql_2)->setParameter('id', $id_historia_clinica);
        $tratamientos = $query_1->getResult();
        $tratamientosex = $query_2->getResult();
        return $this->render('TratamientoBundle:Tratamiento:tratamiento.html.twig',
                             array(
                                 'tratamientos' => $tratamientos,
                                 'tratamientosex' => $tratamientosex
                             ));
    }
    
}
