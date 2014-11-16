<?php

namespace Neurologia\HistoriaClinicaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Neurologia\HistoriaClinicaBundle\Form\Formularios;
use Neurologia\BDBundle\Entity\Motivo;
use Neurologia\BDBundle\Entity\HistoriaClinica;
use Neurologia\BDBundle\Entity\EnfermedadActual;
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
        
        
        //Cargo la Historia clinica si tiene, sino viene vacio
        $params['historia']= $this->vistaHistoria($idpaciente);
        //formulario para crear historia
        $form = Formularios::createIniciarForm($this,$idpaciente);
        $params['iniciar'] = $form->createView();

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
        $form = Formularios::createHistoriaForm($this,$list,$idpaciente);
        $form->handleRequest($request);
        if ($form->isValid()) {
           if( $form->get('enviar')->isClicked()){
              //guardo los datos
              $this->guardarHistoria($form,$idpaciente);
           }
            return $this->redirect($this->generateUrl('neurologia_historia_clinica_homepage'));
        }
        $params['iniciar'] = $form->createView();
        return $this->render('NeurologiaHistoriaClinicaBundle:Default:iniciar.html.twig', $params);
    }
    
   public function guardarHistoria($form,$idpaciente) {
       //derivado
               //$var = $form->get('yourformfieldname')->getData();
               $em = $this->getDoctrine()->getManager();
               $paciente = $em->getRepository('NeurologiaBDBundle:Paciente')->find($idpaciente);
               $derivado = $em->getRepository('NeurologiaBDBundle:Departamento')->find($form->get('derivado')->getData());
               $paciente->setDerivadoPor($derivado);
               $em->persist($paciente);
               $em->flush();
        //historia
               $historia = new HistoriaClinica();
               $historia->setPaciente($paciente);
               $em->persist($historia);
               $em->flush();
               $historiaNueva = $em->getRepository('NeurologiaBDBundle:HistoriaClinica')->findOneBy(
                array(
                        'paciente' => 1,
                ));
        //motivo
               $motivo = new Motivo();
               $motivo->setDetalle($form->get('motivo')->getData());
               $motivo->setHistoriaClinica($historiaNueva);
               $em->persist($motivo);
               $em->flush();
        //enfermedadActual
               $enfermedad = new EnfermedadActual();
               $enfermedad->setDetalle($form->get('enfermedad')->getData());
               $enfermedad->setHistoriaClinica($historiaNueva);
               $em->persist($enfermedad);
               $em->flush();
        //faltaria crear la evolucion pero no tengo manera de agregar un usuario
               
   }
   
   public function vistaHistoria($idpaciente){
       $aux = array();
       $em = $this->getDoctrine()->getManager();
       
       $paciente = $em->getRepository('NeurologiaBDBundle:Paciente')->find($idpaciente);
       $historia = $em->getRepository('NeurologiaBDBundle:HistoriaClinica')->findOneBy(
                array(
                        'paciente' => $paciente->getId(),
                ));
       
       $dql1 = "select MAX(m.id) as id from NeurologiaBDBundle:EnfermedadActual m";
       $query1 = $em->createQuery($dql1);
       $idEnfermedad = $query1->getResult();
       $enfermedad = $em->getRepository('NeurologiaBDBundle:EnfermedadActual')->findOneBy(
                array(
                        'historiaClinica' => $historia->getId(),
                        'id' => $idEnfermedad[0]['id'],
                ));
       $aux['id']= $historia->getId();
       $aux['enfermedad'] = $enfermedad->getDetalle();
       
       $aux['usuario'] = 'usuariolog';
       
       $dql = "select MAX(m.id) as id from NeurologiaBDBundle:Motivo m";
       $query = $em->createQuery($dql);
       $idMotivo = $query->getResult();
       $motivo = $em->getRepository('NeurologiaBDBundle:Motivo')->findOneBy(
                array(
                        'historiaClinica' => $historia->getId(),
                        'id' => $idMotivo[0]['id'],
                ));
       $aux['motivo'] = $motivo->getDetalle();
       
       $departamento = $em->getRepository('NeurologiaBDBundle:Departamento')->find($paciente->getDerivadoPor());
       $aux['departamento'] = $departamento->getDescripcion();
       return $aux;
   }
    
}
