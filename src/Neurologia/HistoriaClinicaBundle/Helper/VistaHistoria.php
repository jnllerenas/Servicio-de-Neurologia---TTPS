<?php
namespace Neurologia\HistoriaClinicaBundle\Helper;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VistaHistoria
 *
 * @author Wodan
 */

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class VistaHistoria extends Controller{
    
    private $em;
    
    public function __construct() {
        $this->em = $this->getDoctrine()->getManager();
        
    }

    public function vistaListado($idhistoria) {
       //devuelve una lista ordenada por fecha , de todo lo relacionado con el paciente
       // fecha  tipo tipoDetalle descipcion.
       
       // diagnosticos
        $builder2 = $this->em->createQueryBuilder();
        $builder2->select('e.fechaHora as fecha, cd.descripcion')
            ->from('NeurologiaBDBundle:DiagnosticoDefinitivo', 'dd')
            ->innerJoin('dd.evolucion', 'e', 'WITH', 'e.historiaClinica = :id')
            ->setParameter('id', $id)
            ->innerJoin('NeurologiaBDBundle:CategoriaDiagnostico', 'cd', 'WITH', 'dd.categoriaDiagnostico=cd.id');

        $diagnosticod = $builder2->getQuery()->execute();
        if (!$diagnosticod){ $diagnosticod = array();}
        else {
            foreach ($diagnosticod as &$m) {
                $m['tipo'] = 'Diagnóstico';
                $m['tipoDetalle'] = 'Definitivo';
                $m['droga'] = false;
            }
        }
        
        $builder3 = $this->em->createQueryBuilder();
        $builder3->select('e.fechaHora as fecha, dp.descripcion')
            ->from('NeurologiaBDBundle:DiagnosticoPresuntivo', 'dp')
            ->innerJoin('dp.evolucion', 'e', 'WITH', 'e.historiaClinica = :id')
            ->setParameter('id', $id);

        $diagnosticop = $builder3->getQuery()->execute();
        if (!$diagnosticop){ $diagnosticop = array();}
        else {
            foreach ($diagnosticop as &$m) {
                $m['tipo'] = 'Diagnóstico';
                $m['tipoDetalle'] = 'Presuntivo';
                $m['droga'] = false;
            }
        }
       //tratamientos 
        $builder = $this->em->createQueryBuilder();
        $builder->select('e.fechaHora as fecha, te.descripcion, te.id as idt')
            ->from('NeurologiaBDBundle:TratamientoInterno', 'te')
            ->innerJoin('te.evolucion', 'e', 'WITH', 'e.historiaClinica = :id')
            ->setParameter('id', $id);

        $tratemientoi = $builder->getQuery()->execute();
        if (!$tratemientoi){ $tratemientoi = array();}
        else {
            foreach ($tratemientoi as &$m) {
                $m['tipo'] = 'Tratamiento';
                $m['tipoDetalle'] = 'Interno';
            }
        }
        foreach ($tratemientoi as &$t){
                $builderx = $this->em->createQueryBuilder();
                $builderx->select('dt.dosis, d.descripcion as droga')
                    ->from('NeurologiaBDBundle:DrogaTratamiento', 'dt')
                    ->innerJoin('dt.droga', 'd', 'WITH', 'dt.tratamiento = :idt')
                    ->setParameter('idt', $t['idt']);
                
                $droga = $builderx->getQuery()->execute();
                if (!$droga){ $droga = array();}
                $t['droga']=$droga;
        }
        
        
        $dql4 = "select e.fechaHora as fecha, te.descripcion from NeurologiaBDBundle:TratamientoExterno te "
                . "inner join NeurologiaBDBundle:Evolucion e "
                . "where e.historiaClinica=:id and te.evolucion=e.id";
        $query4 = $this->em->createQuery($dql4);
        $query4->setParameter('id', $id);
        $tratamientoe = $query4->getResult();
        if (!$tratamientoe){ $tratamientoe = array();}
        else {
            foreach ($tratamientoe as &$m) {
                $m['tipo'] = 'Tratemiento';
                $m['tipoDetalle'] = 'Externo';
                $m['droga'] = false;
            }
        }
       // estudios
       $builder5 = $this->em->createQueryBuilder();
        $builder5->select('e.fechaHora as fecha, es.descripcion, te.siglas as tipoDetalle')
            ->from('NeurologiaBDBundle:Estudio', 'es')
            ->innerJoin('es.evolucion', 'e', 'WITH', 'e.historiaClinica = :id')
            ->setParameter('id', $id)
            ->innerJoin('NeurologiaBDBundle:TipoEstudio', 'te', 'WITH', 'es.tipoEstudio=te.id');
        //se podria agregar la imagen
        $estudios = $builder5->getQuery()->execute();
        if (!$estudios){ $estudios = array();}
        else {
            foreach ($estudios as &$m) {
                $m['tipo'] = 'Estudio';
                $m['droga'] = false;
            }
        }
       // motivos
        $dql = "select m.fecha, m.detalle as descripcion from NeurologiaBDBundle:Motivo m where m.historiaClinica=:id";
        $query = $this->em->createQuery($dql);
        $query->setParameter('id', $id);
        $motivos = $query->getResult();
        if (!$motivos){ $motivos = array();}
        else {
            foreach ($motivos as &$m) {
                $m['tipo'] = 'Motivo';
                $m['tipoDetalle'] = false;
                $m['droga'] = false;
            }
        }
       // enfermedades
        $dql1 = "select m.fecha, m.detalle as descripcion from NeurologiaBDBundle:EnfermedadActual m where m.historiaClinica=:id";
        $query1 = $this->em->createQuery($dql1);
        $query1->setParameter('id', $id);
        $enfermedades = $query1->getResult();
        if (!$enfermedades){ $enfermedades = array();}
        else {
            foreach ($enfermedades as &$m) {
                $m['tipo'] = 'Enfermedad Acutal';
                $m['tipoDetalle'] = false;
                $m['droga'] = false;
            }
        }
       // antecedentes
       $dql2 = "select m.fecha, m.descripcion, ma.descripcion as tipoDetalle "
               . "from NeurologiaBDBundle:Antecedente m "
               . "inner join NeurologiaBDBundle:TipoAntecedente ma "
               . "where m.historiaClinica=:id and ma.id=m.tipoAntecedente";
        $query2 = $this->em->createQuery($dql2);
        $query2->setParameter('id', $id);
        $antecedentes = $query2->getResult();
        if (!$antecedentes){ $antecedentes = array();}
        else {
            foreach ($antecedentes as &$m) {
                $m['tipo'] = 'Antecedente';
                $m['droga'] = false;
            }
        }
       
       // ordenamos y devolvemos
       $listado = array_merge($tratemientoi, $tratamientoe, $diagnosticod, $diagnosticop,$estudios, $motivos, $enfermedades, $antecedentes);
       usort($listado, array($this, 'ordenar'));
       return $listado;
       
   }
   
   function ordenar( $a, $b ) {
    return strtotime($a['fecha']->format('Y-m-d')) - strtotime($b['fecha']->format('Y-m-d'));
   }
   
   public function vistaHistoria($idpaciente){
       $aux = array();
       $paciente = $this->em->getRepository('NeurologiaBDBundle:Paciente')->find($idpaciente);
       $historia = $this->em->getRepository('NeurologiaBDBundle:HistoriaClinica')->findOneBy(
                array(
                        'paciente' => $paciente->getId(),
                ));
       if (!$historia) {
           return false;
       }
       $dql1 = "select MAX(m.id) as id from NeurologiaBDBundle:EnfermedadActual m where m.historiaClinica=:id";
       $query1 = $this->em->createQuery($dql1);
       $query1->setParameter('id', $historia->getId());
       $idEnfermedad = $query1->getResult();
       $enfermedad = $this->em->getRepository('NeurologiaBDBundle:EnfermedadActual')->findOneBy(
                array(
                        'historiaClinica' => $historia->getId(),
                        'id' => $idEnfermedad[0]['id'],
                ));
        if (!$enfermedad) {
            throw $this->createNotFoundException('Unable to find Enfermedad ');
        }
       $aux['id']= $historia->getId();
       $aux['enfermedad'] = $enfermedad->getDetalle();
       
      // $usu = $em->getRepository('NeurologiaBDBundle:User')->find($paciente->getAdmitidoPor());
      // if (!$usu) {
      //      throw $this->createNotFoundException('Unable to find Admitido por ');
      //  }
      // $aux['usuario'] = $usu->getNombre();
       $aux['usuario'] = 'admin'; 
       $dql = "select MAX(m.id) as id from NeurologiaBDBundle:Motivo m where m.historiaClinica=:id";
       $query = $this->em->createQuery($dql);
       $query->setParameter('id', $historia->getId());
       $idMotivo = $query->getResult();
       $motivo = $this->em->getRepository('NeurologiaBDBundle:Motivo')->findOneBy(
                array(
                        'historiaClinica' => $historia->getId(),
                        'id' => $idMotivo[0]['id'],
                ));
       if (!$motivo) {
            throw $this->createNotFoundException('Unable to find Motivo ');
        }
       $aux['motivo'] = $motivo->getDetalle();
       
       if($paciente->getDerivadoPor()){
       $departamento = $this->em->getRepository('NeurologiaBDBundle:Departamento')->find($paciente->getDerivadoPor());
       $aux['departamento'] = $departamento->getDescripcion();
       }
       else{
           $aux['departamento'] = 'ninguno';
       }
       return $aux;
       
      
   }
}
