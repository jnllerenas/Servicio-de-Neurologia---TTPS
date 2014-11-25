<?php

namespace Neurologia\AntecedenteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Neurologia\BDBundle\Entity\Antecedente;
use Neurologia\AntecedenteBundle\Form\AntecedenteType;

/**
 * Antecedente controller.
 *
 */
class AntecedenteController extends Controller
{

    /**
     * Lists all Antecedente entities.
     *
     */
    public function indexAction($idhistoria)
    {
        $em = $this->getDoctrine()->getManager();
        $vars['historia'] = $em->getRepository('NeurologiaBDBundle:HistoriaClinica')->find($idhistoria);
        $tipoAntecedente= $em->getRepository('NeurologiaBDBundle:TipoAntecedente');

        $vars['familiares'] = $em->getRepository('NeurologiaBDBundle:Antecedente')->findBy(
            array(
                'historiaClinica' => $vars['historia']->getId(),
                'tipoAntecedente' => $tipoAntecedente->findOneBy(array('descripcion'=>'familiar'))->getId()
                ));
        $vars['personales'] = $em->getRepository('NeurologiaBDBundle:Antecedente')->findBy(
            array(
                'historiaClinica' => $vars['historia']->getId(),
                'tipoAntecedente' => $tipoAntecedente->findOneBy(array('descripcion'=>'personal'))->getId()
                ));

        return $this->render('NeurologiaAntecedenteBundle:Antecedente:index.html.twig', $vars);
    }
    /**
     * Creates a new Antecedente entity.
     *
     */
    public function createAction(Request $request,$idhistoria)
    {
        $mensaje="";
        $fecha=new \DateTime("now"); 
        $antecedente = new Antecedente();
        $form = $this->createCreateForm($antecedente,$idhistoria);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $historia = $em->getRepository('NeurologiaBDBundle:HistoriaClinica')->find($idhistoria);
        if ($form->isValid()) {
            $tipoAntecedente=$antecedente->getTipoAntecedente();
            $usuario = $em->getRepository('NeurologiaBDBundle:User')->find(1);
            $existe = $em->getRepository('NeurologiaBDBundle:Antecedente')
                        ->findOneBy(array('historiaClinica' => $historia->getId(),
                                    'tipoAntecedente' => $tipoAntecedente->getId(),
                                    'descripcion' => $antecedente->getDescripcion()));
            if(!$existe){
                $antecedente->setFecha($fecha);
                $antecedente->setHistoriaClinica($historia);
                $antecedente->setUsuario($usuario);
                $em->persist($antecedente);
                $em->flush();
                
            return $this->redirect($this->generateUrl('neurologia_historia_clinica_homepage', array('idpaciente' => $historia->getPaciente()->getId(),'solapa' =>'Antecedente')));
    
            }else{
                $mensaje="Ya existe un antecedente ".$tipoAntecedente->getDescripcion()." con la descripción: ".$antecedente->getDescripcion()." para este paciente.";
            }

            
        }
        $vars=array("antecedente" => $antecedente,
                "form" => $form->createView(),
                "historia" => $historia,
                "mensaje" => $mensaje);

        return $this->render('NeurologiaAntecedenteBundle:Antecedente:new.html.twig', $vars);
    }

    /**
     * Creates a form to create a Antecedente entity.
     *
     * @param Antecedente $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Antecedente $antecedente, $idhistoria)
    {
        $form = $this->createForm(new AntecedenteType(), $antecedente, array(
            'action' => $this->generateUrl('antecedente_create',array('idhistoria'=>$idhistoria)),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear'));

        return $form;
    }

    /**
     * Displays a form to create a new Antecedente entity.
     *
     */
    public function newAction($idhistoria)
    {
        $mensaje="";
        $vars['antecedente'] = new Antecedente();
        $em = $this->getDoctrine()->getManager();
        $vars['historia'] = $em->getRepository('NeurologiaBDBundle:HistoriaClinica')->find($idhistoria);
        $vars['form'] = $this->createCreateForm($vars['antecedente'],$idhistoria)->createView();
        $vars['mensaje'] = $mensaje;
        return $this->render('NeurologiaAntecedenteBundle:Antecedente:new.html.twig', $vars);
    }

    
}
