<?php

namespace Neurologia\HistoriaClinicaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Neurologia\HistoriaClinicaBundle\Form\Formularios;
use Neurologia\BDBundle\Entity\Motivo;
use Neurologia\BDBundle\Entity\HistoriaClinica;
use Neurologia\BDBundle\Entity\EnfermedadActual;
use Neurologia\BDBundle\Entity\Evolucion;
use Ps\PdfBundle\Annotation\Pdf;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller {

    private function routeToControllerName($routename) {
        $routes = $this->get('router')->getRouteCollection();
        return $routes->get($routename)->getDefaults()['_controller'];
    }

    public function indexAction() {
        //si llegamos acá supuestamente tenemos seleccionado un paciente
        $params = array();
        //Cargo datos paciente
        $paciente = $_SESSION['paciente'];
        $em = $this->getDoctrine()->getManager();
        $params['paciente'] = $em->merge($paciente);
        //Cargo la Historia clinica si tiene, sino viene vacio
        $params['historia'] = $this->vistaHistoria();
        //formulario para crear historia
        $form = Formularios::createIniciarForm($this);
        $params['iniciar'] = $form->createView();
        //historial
        $params['listado'] = $this->vistaListado($params['historia']['id']);

        // deberia dirigirme a NeurologiaHistoriaClinicaBundle:Default:tabs
        // y que me devuelva el render de la vista que le pase como parámetro(por defecto va a ser null)
        // usando el script de jona marco como actual y luego todas la peticiones van a caer aca.
        // por lo que deberia redirigar eso hacia el nuevo routing y volverlo a imprimir
        //espero que funcione
        if (isset($_GET['accion'])) {

            $contenido = $this->forward($this->routeToControllerName($_GET['accion']), array());
            $params['contenido'] = $contenido->getContent();
            $params['tab'] = $_GET['tab'];
            
        }else{
            
            $contenido = $this->forward($this->routeToControllerName('evolucion_listar'), array());
            $params['contenido'] = $contenido->getContent();
            $params['tab'] = 'Evolucion';
            
        }
        
        return $this->render('NeurologiaHistoriaClinicaBundle:Default:index.html.twig', $params);
    }

    public function iniciarAction(Request $request) {
        $params = array();
        $em = $this->getDoctrine()->getManager();
        $idpaciente = $_SESSION['paciente']->getId();
        $departamentos = $em->getRepository('NeurologiaBDBundle:Departamento')->findAll();
        $list = array();
        foreach ($departamentos as $row) {
            $list[$row->getId()] = $row->getDescripcion();
        }

        $form = Formularios::createHistoriaForm($this, $list);
        $form->handleRequest($request);
        if ($form->isValid()) {
            if ($form->get('enviar')->isClicked()) {
                //guardo los datos
                $this->guardarHistoria($form);
            }
            return $this->redirect($this->generateUrl('neurologia_historia_clinica_homepage'));
        }
        $params['iniciar'] = $form->createView();
        $params['historia'] = $idpaciente;
        return $this->render('NeurologiaHistoriaClinicaBundle:Default:iniciar.html.twig', $params);
    }

	public function epicrisisAction()
    {

        $params = array(); 
        $paciente = $_SESSION['paciente'];
        $em = $this->getDoctrine()->getManager();
        $params['paciente'] = $em->merge($paciente);
        $params['historia'] = $this->vistaHistoria();
        $params['listado']= $this->vistaListado( $params['historia']['id']);
      	
        $facade = $this->get('ps_pdf.facade');
        $response = new Response();
        $this->render('NeurologiaHistoriaClinicaBundle:Default:pdf.pdf.twig', $params ,$response);
        $xml = $response->getContent();
        $content = $facade->render($xml);
        
        return new Response($content, 200, array('content-type' => 'application/pdf'));
 
    }

    public function guardarHistoria($form) {

        $em = $this->getDoctrine()->getManager();
        try {



            $em->getConnection()->beginTransaction();
            //paciente        
            $paciente = $em->merge($_SESSION['paciente']);
            $usuario = $em->getRepository('NeurologiaBDBundle:User')->find($_SESSION['user']->getId()); 
            $paciente->setAdmitidoPor($usuario); // modifico para usar $usuario
            if ($form->get('derivado')->getData() !== 0) {
                $derivado = $em->getRepository('NeurologiaBDBundle:Departamento')->find($form->get('derivado')->getData());
                $paciente->setDerivadoPor($derivado);
            } else {
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
                        'paciente' => $paciente->getId(),
            ));
            //motivo
            $time = new \DateTime();
            $motivo = new Motivo();
            $motivo->setDetalle($form->get('motivo')->getData());
            $motivo->setHistoriaClinica($historiaNueva);
            $motivo->setFecha($time);
            $motivo->setUsuario($usuario); //agrego nahuel motivo: no se puede agregar sin id de usuario
            $em->persist($motivo);
            $em->flush();
            //enfermedadActual
            $enfermedad = new EnfermedadActual();
            $enfermedad->setDetalle($form->get('enfermedad')->getData());
            $enfermedad->setHistoriaClinica($historiaNueva);
            $enfermedad->setFecha($time);
            $enfermedad->setUsuario($usuario); //agrego nahuel motivo: no se puede agregar sin id de usuario
            $em->persist($enfermedad);
            $em->flush();


            $em->getConnection()->commit();
        } catch (Exception $e) {
            // Rollback the failed transaction attempt
            $em->getConnection()->rollback();
            throw $e;
        }
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
        if (!$diagnosticod) {
            $diagnosticod = array();
        } else {
            foreach ($diagnosticod as &$m) {
                $m['tipo'] = 'Diagnóstico';
                $m['tipoDetalle'] = 'definitivo';
                $m['droga'] = false;
            }
        }

        $builder3 = $em->createQueryBuilder();
        $builder3->select('e.fechaHora as fecha, dp.descripcion')
                ->from('NeurologiaBDBundle:DiagnosticoPresuntivo', 'dp')
                ->innerJoin('dp.evolucion', 'e', 'WITH', 'e.historiaClinica = :id')
                ->setParameter('id', $id);

        $diagnosticop = $builder3->getQuery()->execute();
        if (!$diagnosticop) {
            $diagnosticop = array();
        } else {
            foreach ($diagnosticop as &$m) {
                $m['tipo'] = 'Diagnóstico';
                $m['tipoDetalle'] = 'presuntivo';
                $m['droga'] = false;
            }
        }
        //tratamientos 
        $builder = $em->createQueryBuilder();
        $builder->select('e.fechaHora as fecha, te.descripcion, te.id as idt')
                ->from('NeurologiaBDBundle:TratamientoInterno', 'te')
                ->innerJoin('te.evolucion', 'e', 'WITH', 'e.historiaClinica = :id')
                ->setParameter('id', $id);

        $tratemientoi = $builder->getQuery()->execute();
        if (!$tratemientoi) {
            $tratemientoi = array();
        } else {
            foreach ($tratemientoi as &$m) {
                $m['tipo'] = 'Tratamiento';
                $m['tipoDetalle'] = 'interno';
            }
        }
        foreach ($tratemientoi as &$t) {
            $builderx = $em->createQueryBuilder();
            $builderx->select('dt.dosis, d.descripcion as droga')
                    ->from('NeurologiaBDBundle:DrogaTratamiento', 'dt')
                    ->innerJoin('dt.droga', 'd', 'WITH', 'dt.tratamiento = :idt')
                    ->setParameter('idt', $t['idt']);

            $droga = $builderx->getQuery()->execute();
            if (!$droga) {
                $droga = array();
            }
            $t['droga'] = $droga;
            
        }


        $dql4 = "select e.fechaHora as fecha, te.descripcion from NeurologiaBDBundle:TratamientoExterno te "
                . "inner join NeurologiaBDBundle:Evolucion e "
                . "where e.historiaClinica=:id and te.evolucion=e.id";
        $query4 = $em->createQuery($dql4);
        $query4->setParameter('id', $id);
        $tratamientoe = $query4->getResult();
        if (!$tratamientoe) {
            $tratamientoe = array();
        } else {
            foreach ($tratamientoe as &$m) {
                $m['tipo'] = 'Tratamiento';
                $m['tipoDetalle'] = 'externo';
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
        if (!$estudios) {
            $estudios = array();
        } else {
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
        if (!$motivos) {
            $motivos = array();
        } else {
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
        if (!$enfermedades) {
            $enfermedades = array();
        } else {
            foreach ($enfermedades as &$m) {
                $m['tipo'] = 'Enfermedad actual';
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
        if (!$antecedentes) {
            $antecedentes = array();
        } else {
            foreach ($antecedentes as &$m) {
                $m['tipo'] = 'Antecedente';
                $m['droga'] = false;
            }
        }

        // ordenamos y devolvemos
        $listado = array_merge($tratemientoi, $tratamientoe, $diagnosticod, $diagnosticop, $estudios, $motivos, $enfermedades, $antecedentes);
        usort($listado, array($this, 'ordenar'));
        return $listado;
    }

    function ordenar($a, $b) {
        return strtotime($b['fecha']->format('Y-m-d H:i:d')) - strtotime($a['fecha']->format('Y-m-d H:i:d'));
    }

    public function vistaHistoria() {
        $em = $this->getDoctrine()->getManager();
        $idpaciente = $_SESSION['paciente']->getId();
        $aux = array();
        $paciente = $em->getRepository('NeurologiaBDBundle:Paciente')->find($idpaciente);
        $historia = $em->getRepository('NeurologiaBDBundle:HistoriaClinica')->findOneBy(
                array(
                    'paciente' => $paciente->getId(),
        ));
        if (!$historia) {
            return false;
        }
        $_SESSION['historia'] = $historia;
        $dql1 = "select MAX(m.id) as id from NeurologiaBDBundle:EnfermedadActual m where m.historiaClinica=:id";
        $query1 = $em->createQuery($dql1);
        $query1->setParameter('id', $historia->getId());
        $idEnfermedad = $query1->getResult();
        $enfermedad = $em->getRepository('NeurologiaBDBundle:EnfermedadActual')->findOneBy(
                array(
                    'historiaClinica' => $historia->getId(),
                    'id' => $idEnfermedad[0]['id'],
        ));
        if (!$enfermedad) {
            throw $this->createNotFoundException('No se encontró Enfermedad ');
        }
        $aux['id'] = $historia->getId();
        $aux['enfermedad'] = $enfermedad->getDetalle();


        $aux['usuario'] = $_SESSION['user']->getUsername();
        $dql = "select MAX(m.id) as id from NeurologiaBDBundle:Motivo m where m.historiaClinica=:id";
        $query = $em->createQuery($dql);
        $query->setParameter('id', $historia->getId());
        $idMotivo = $query->getResult();
        $motivo = $em->getRepository('NeurologiaBDBundle:Motivo')->findOneBy(
                array(
                    'historiaClinica' => $historia->getId(),
                    'id' => $idMotivo[0]['id'],
        ));
        if (!$motivo) {
            throw $this->createNotFoundException('No se encontró Motivo ');
        }
        $aux['motivo'] = $motivo->getDetalle();

        if ($paciente->getDerivadoPor()!==NULL) {
            $departamento = $em->getRepository('NeurologiaBDBundle:Departamento')->find($paciente->getDerivadoPor());
            $aux['departamento'] = $departamento->getDescripcion();
        } else {
            $aux['departamento'] = 'ninguno';
        }
        return $aux;
    }

}
