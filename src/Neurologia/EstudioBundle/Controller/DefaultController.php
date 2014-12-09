<?php

namespace Neurologia\EstudioBundle\Controller;

use Neurologia\BDBundle\Entity\Estudio;
use Neurologia\EstudioBundle\Form\Type\EstudioType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    public function nuevoAction(Request $request) {
        $estudio = new Estudio();
        $error = "";

        $form = $this->createForm(new EstudioType(), $estudio);

        $cloned = clone $form;

        $form->handleRequest($request);
        
        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $idevo = $_SESSION['evolucion'][0]->getId();
            $evolucion = $em->merge($_SESSION['evolucion'][0]);
            $estudio->setEvolucion($evolucion);
            $em->persist($estudio);
            $em->flush();
            $imagenes = $estudio->getImagenes();
            foreach ($imagenes as $value) {
                $imagen = $em->merge($value);
                $imagen->addEstudio($estudio);
                $em->persist($imagen);
                $em->flush();
            }

            return $this->redirect($this->generateUrl('neurologia_historia_clinica_homepage', array('accion' => 'evolucion_modificar', 'id' => $idevo, 'tab' => 'Evolucion')));
        }


        if (!($form->get('imagenes')->isEmpty())) {
            $error = $form->get('imagenes')->getErrorsAsString();
            $form = $cloned;
        }




        return $this->render('NeurologiaEstudioBundle:Default:nuevo.html.twig', array(
                    'form' => $form->createView(), 'error' => $error
        ));
    }

    public function successAction() {


        return $this->render('NeurologiaEstudioBundle:Default:success.html.twig');
    }

    public function listarAction() {        //HistoriaClinica $historiaClinica){
        $em = $this->getDoctrine()->getManager();
        $historia = $em->merge($_SESSION['historia']);
        $id_historia = $historia->getId();
        $qb = $em->createQueryBuilder();
        $qb->select('e')
                ->from('NeurologiaBDBundle:Estudio', 'e')
                ->innerJoin('NeurologiaBDBundle:Evolucion', 'ev', 'WITH', 'e.evolucion = ev')
                ->where('ev.historiaClinica = :id')
                ->setParameter('id', $id_historia);
        $estudios = $qb->getQuery()->execute();
        if (!$estudios) {
            $estudios = array();
        }
//        else {
//            foreach ($estudios as $e) {
//                echo ($e->getFecha()->format('Y-m-d'));
//                
//            }
//        }

        return $this->render('NeurologiaEstudioBundle:Default:listar.html.twig', array(
                    'estudios' => $estudios));
    }

    public function showAction() {
        $id = $_GET['id'];
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('NeurologiaBDBundle:Estudio')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find estudio entity.');
        }


        return $this->render('NeurologiaEstudioBundle:Default:show.html.twig', array('estudio' => $entity));
    }

    public function deleteAction($key) {
        if (array_key_exists($key, $_SESSION['estudios'])) {
            $imagenes = $_SESSION['estudios'][$key]->getImagenes();
            foreach ($imagenes as $value) {
                $value->removeUpload();
            }
            unset($_SESSION['estudios'][$key]);
        }
        //   return $this->redirect($this->generateUrl('evolucion_nuevo'));
    }

    public function editAction(Request $request, $key) {
        if (array_key_exists($key, $_SESSION['estudios'])) {
            $estudio = $_SESSION['estudios'][$key];
            $imagenesold = $_SESSION['estudios'][$key]->getImagenes();
            foreach ($imagenesold as $value) {
                $value->removeUpload();
                $_SESSION['estudios'][$key]->removeImagen($value);
            }
            $error = "";

            $form = $this->createForm(new EstudioType(), $estudio);

            $cloned = clone $form;
            $form->handleRequest($request);

            if ($form->isValid()) {

                $imagenes = $estudio->getImagenes();
                foreach ($imagenes as $value) {
                    $value->preupload();
                    $value->upload();
                }
                $_SESSION['estudios'][$key] = $estudio;

                //    return $this->redirect($this->generateUrl('evolucion_nuevo'));
            }


//            if (!($form->get('imagenes')->isEmpty())) {
//                $error = $form->get('imagenes')->getErrorsAsString();
//                $form = $cloned;            
//                
//            }
        }


        return $this->render('NeurologiaEstudioBundle:Default:editar.html.twig', array(
                    'form' => $form->createView(), 'error' => $error
        ));
    }

}
