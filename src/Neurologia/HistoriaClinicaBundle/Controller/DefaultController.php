<?php

namespace Neurologia\HistoriaClinicaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Neurologia\HistoriaClinicaBundle\Form\Formularios;
use Neurologia\BDBundle\Entity\Motivo;
use Neurologia\BDBundle\Entity\HistoriaClinica;
use Neurologia\BDBundle\Entity\EnfermedadActual;
use Neurologia\BDBundle\Entity\Paciente;
class DefaultController extends Controller
{
    public function indexAction($idpaciente)
    {
        //si llegamos acá supuestamente tenemos seleccionado un paciente
        $params = array(); 
        //Cargo datos paciente
        $paciente = $idpaciente;
        $em = $this->getDoctrine()->getManager();
        $params['paciente'] = $em->getRepository('NeurologiaBDBundle:Paciente')->find($paciente);
        
        if (!$params['paciente']) {
            throw $this->createNotFoundException('Unable to find Paciente ');
        }
        //Cargo la Historia clinica si tiene, sino viene vacio
        $params['historia']= $this->vistaHistoria($idpaciente);
        //formulario para crear historia
        $form = Formularios::createIniciarForm($this,$idpaciente);
        $params['iniciar'] = $form->createView();
        //historial
        $params['listado'] = $this->vistaListado($params['historia']['id']);
        return $this->render('NeurologiaHistoriaClinicaBundle:Default:index.html.twig', $params);
    }
    
    public function iniciarAction(Request $request, $idpaciente)
    {
        $params=array();
        $em = $this->getDoctrine()->getManager();
        $departamentos = $em->getRepository('NeurologiaBDBundle:Departamento')->findAll();
        $list = array();        
        foreach ($departamentos as $row) {
            $list[$row->getId()] = $row->getDescripcion();
        }
        $list[0]= 'ninguno';
        $form = Formularios::createHistoriaForm($this,$list,$idpaciente);
        $form->handleRequest($request);
        if ($form->isValid()) {
           if( $form->get('enviar')->isClicked()){
              //guardo los datos
              $this->guardarHistoria($form,$idpaciente);
           }
            return $this->redirect($this->generateUrl('neurologia_historia_clinica_homepage', array('idpaciente' => $idpaciente)));
        }
        $params['iniciar'] = $form->createView();
        return $this->render('NeurologiaHistoriaClinicaBundle:Default:iniciar.html.twig', $params);
    }
    
   public function guardarHistoria($form,$idpaciente) {
       //paciente
               $em = $this->getDoctrine()->getManager();
               $paciente = $em->getRepository('NeurologiaBDBundle:Paciente')->find($idpaciente);
               //$usuario = $em->getRepository('NeurologiaBDBundle:User')->find(1);
               //$paciente->setAdmitidoPor($usuario);
               if ($form->get('derivado')->getData()){
               $derivado = $em->getRepository('NeurologiaBDBundle:Departamento')->find($form->get('derivado')->getData());
               $paciente->setDerivadoPor($derivado);
               }
               else{
                   $paciente->setDerivadoPor(NULL);
               }
               $em->persist($paciente);
               $em->flush();
        //historia
               $historia = new HistoriaClinica();
               $historia->setPaciente($paciente);
               $em->persist($historia);
               $em->flush();
               $historiaNueva = $em->getRepository('NeurologiaBDBundle:HistoriaClinica')->findOneBy(
                array(
                        'paciente' => $idpaciente,
                ));
        //motivo
               $time = new \DateTime();
               $motivo = new Motivo();
               $motivo->setDetalle($form->get('motivo')->getData());
               $motivo->setHistoriaClinica($historiaNueva);
               $motivo->setFecha($time);
               $em->persist($motivo);
               $em->flush();
        //enfermedadActual
               $enfermedad = new EnfermedadActual();
               $enfermedad->setDetalle($form->get('enfermedad')->getData());
               $enfermedad->setHistoriaClinica($historiaNueva);
               $enfermedad->setFecha($time);
               $em->persist($enfermedad);
               $em->flush();
        //evolucion?
               
               
   }
   
   public function vistaHistoria($idpaciente){
       $aux = array();
       $em = $this->getDoctrine()->getManager();
       
       $paciente = $em->getRepository('NeurologiaBDBundle:Paciente')->find($idpaciente);
       $historia = $em->getRepository('NeurologiaBDBundle:HistoriaClinica')->findOneBy(
                array(
                        'paciente' => $paciente->getId(),
                ));
       if (!$historia) {
           return false;
       }
       $dql1 = "select MAX(m.id) as id from NeurologiaBDBundle:EnfermedadActual m";
       $query1 = $em->createQuery($dql1);
       $idEnfermedad = $query1->getResult();
       $enfermedad = $em->getRepository('NeurologiaBDBundle:EnfermedadActual')->findOneBy(
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
       $dql = "select MAX(m.id) as id from NeurologiaBDBundle:Motivo m";
       $query = $em->createQuery($dql);
       $idMotivo = $query->getResult();
       $motivo = $em->getRepository('NeurologiaBDBundle:Motivo')->findOneBy(
                array(
                        'historiaClinica' => $historia->getId(),
                        'id' => $idMotivo[0]['id'],
                ));
       if (!$motivo) {
            throw $this->createNotFoundException('Unable to find Motivo ');
        }
       $aux['motivo'] = $motivo->getDetalle();
       
       if($paciente->getDerivadoPor()){
       $departamento = $em->getRepository('NeurologiaBDBundle:Departamento')->find($paciente->getDerivadoPor());
       $aux['departamento'] = $departamento->getDescripcion();
       }
       else{
           $aux['departamento'] = 'ninguno';
       }
       return $aux;
       
      
   }
   
   public function vistaListado($id) {
       //devuelve una lista ordenada por fecha , de todo lo relacionado con el paciente
       // fecha  tipo tipoDetalle descipcion.
       $em = $this->getDoctrine()->getManager();
       // diagnosticos
       $builder2 = $em->createQueryBuilder();
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
        
        $builder3 = $em->createQueryBuilder();
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
       //tratamientos (por ahora el tema de la droga no es opcional- preguntar)
        $builder = $em->createQueryBuilder();
        $builder->select('e.fechaHora as fecha, te.descripcion, dt.dosis, d.descripcion as droga')
            ->from('NeurologiaBDBundle:TratamientoInterno', 'te')
            ->innerJoin('te.evolucion', 'e', 'WITH', 'e.historiaClinica = :id')
            ->setParameter('id', $id)
            ->innerJoin('NeurologiaBDBundle:DrogaTratamiento', 'dt', 'WITH', 'dt.tratamiento=te.id')
            ->innerJoin('NeurologiaBDBundle:Droga', 'd', 'WITH', 'd.id=dt.droga');

        $tratemientoi = $builder->getQuery()->execute();
        if (!$tratemientoi){ $tratemientoi = array();}
        else {
            foreach ($tratemientoi as &$m) {
                $m['tipo'] = 'Tratamiento';
                $m['tipoDetalle'] = 'Interno';
            }
        }
        
        $dql4 = "select e.fechaHora as fecha, te.descripcion from NeurologiaBDBundle:TratamientoExterno te "
                . "inner join NeurologiaBDBundle:Evolucion e "
                . "where e.historiaClinica=:id and te.evolucion=e.id";
        $query4 = $em->createQuery($dql4);
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
       $builder5 = $em->createQueryBuilder();
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
        $query = $em->createQuery($dql);
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
        $query1 = $em->createQuery($dql1);
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
        $query2 = $em->createQuery($dql2);
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
    
}
