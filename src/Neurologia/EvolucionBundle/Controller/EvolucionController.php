<?php

namespace Neurologia\EvolucionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Neurologia\BDBundle\Entity\Evolucion as Evolucion;
use Neurologia\EvolucionBundle\Form\EvolucionType as EvolucionType;

class EvolucionController extends Controller {

    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $id_historia_clinica = $_SESSION['historia']->getId();
        //supuestamente, viene de session.
        $qb = $em->createQueryBuilder();
        $qb->select('e')
                ->from('NeurologiaBDBundle:Evolucion', 'e')
                ->where('e.historiaClinica = :id')
                ->setParameter('id', $id_historia_clinica)
                ->orderBy('e.fechaHora', 'ASC');
        $evoluciones = $qb->getQuery()->execute();
        return $this->render('EvolucionBundle:Evolucion:evolucion.html.twig', array('evoluciones' => $evoluciones));
    }

    public function newAction(Request $request) {
        if (!isset($_SESSION['evolucion'])) {
            throw $this->createNotFoundException('Asegurese de ingresar a esta sección por la busqueda de pacientes ');
        } else {
            $em = $this->getDoctrine()->getManager();
            $evolucion = $em->merge($_SESSION['evolucion'][0]);
            $historia_clinica = $em->merge($_SESSION['historia']);
            $evolucion->setHistoriaClinica($historia_clinica);
            $evolucion->setFechaHora(new \Datetime());
            $evolucion->setEvolucion('Sin descripción.');
            $usuario = $em->merge($_SESSION['user']);
            $evolucion->setUsuario($usuario);
            $em->persist($evolucion);
            $em->flush();
            // $form = $this->createForm(new EvolucionType(), $evolucion);
            // $form->handleRequest($request);
//        if ($form->isValid()) {
            $_SESSION['evolucion'] = $evolucion;
            //$this->guardarEvolucion();
            $this->get('session')->getFlashBag()->add(
                    'mensaje', 'Se ha agregado exitosamente una evolución.'
            );
//            
//           return $this->redirect($this->generateUrl('neurologia_historia_clinica_homepage'));
//        }
            //$params['form'] = $form->createView();
            //$params['tratinterno'] = $_SESSION['tratamientos']['ti'];
            //$params['tratexterno'] = $_SESSION['tratamientos']['te'];
            //$params['diagnosticos'] = $_SESSION['diagnosticos'];
            //$params['estudios'] = $_SESSION['estudios'];

            return $this->redirect($this->generateUrl('neurologia_historia_clinica_homepage', array('accion' => 'evolucion_modificar', 'id' => $evolucion->getId(), 'tab' => 'Evolucion')));
        }
    }

//    function guardarEvolucion() {
//        $em = $this->getDoctrine()->getManager();
//        try {
//            $em->getConnection()->beginTransaction();
//            //evolucion       
//            $evolucion = $em->merge($_SESSION['evolucion']);
//            $em->persist($evolucion);
//            $em->flush();
//            //tratamientos
//            if (!empty($_SESSION['tratamientos']['ti'])) {
//                foreach ($_SESSION['tratamientos']['ti'] as $row) {
//                    $tratamiento = $em->merge($row);
//                    $tratamiento->agregarTratamientoADrogas();
//                    $tratamiento->setEvolucion($evolucion);
//                    $em->persist($tratamiento);
//                    $em->flush();
//                    $drogas = $row->getDrogaTratamiento();
//                    foreach ($drogas as $value) {
//                        $droga = $em->merge($value);
//                        $droga->addTratamiento($tratamiento);
//                        $em->persist($droga);
//                        $em->flush();
//                    }
//                }
//            }
//            if (!empty($_SESSION['tratamientos']['te'])) {
//                foreach ($_SESSION['tratamientos']['te'] as $row) {
//                    $tratamiento = $em->merge($row);
//                    $tratamiento->setEvolucion($evolucion);
//                    $em->persist($tratamiento);
//                    $em->flush();
//                }
//            }
//
//            //estudios
//            if (!empty($_SESSION['estudios'])) {
//                foreach ($_SESSION['estudios'] as $row) {
//                    $estudio = $em->merge($row);
////                       $estudio->agregarEstudioAImagenes();
//                    $estudio->setEvolucion($evolucion);
//                    $em->persist($estudio);
//                    $em->flush();
//                    $imagenes = $row->getImagenes();
//                    foreach ($imagenes as $value) {
//                        $imagen = $em->merge($value);
//                        $imagen->addEstudio($estudio);
//                        $em->persist($imagen);
//                        $em->flush();
//                    }
//                }
//            }
//
//
//            //diagnosticos
//            if (!empty($_SESSION['diagnosticos'])) {
//                foreach ($_SESSION['diagnosticos'] as $row) {
//                    $diagnostico = $em->merge($row);
//                    $diagnostico->setEvolucion($evolucion);
//                    $em->persist($diagnostico);
//                    $em->flush();
//                }
//            }
//
//            $em->getConnection()->commit();
//        } catch (Exception $e) {
//            // Rollback the failed transaction attempt
//            $em->getConnection()->rollback();
//            throw $e;
//        }
//    }

    public function modificarAction(Request $request) {


        $orm = $this->getDoctrine()->getManager();
        $evolucionRepo = $orm->getRepository('NeurologiaBDBundle:Evolucion');
        $id = $_GET['id'];

        $evolucion = $evolucionRepo->findById($id);
        $_SESSION['evolucion'] = $evolucion;
        $estudioRepo = $orm->getRepository('NeurologiaBDBundle:Estudio');
        $estudios = $estudioRepo->findByEvolucion($evolucion);

        $diagDRepo = $orm->getRepository('NeurologiaBDBundle:DiagnosticoDefinitivo');
        $diagD = $diagDRepo->findByEvolucion($evolucion);

        $diagPRepo = $orm->getRepository('NeurologiaBDBundle:DiagnosticoPresuntivo');
        $diagP = $diagPRepo->findByEvolucion($evolucion);

        $tratIRepo = $orm->getRepository('NeurologiaBDBundle:TratamientoInterno');
        $tratI = $tratIRepo->findByEvolucion($evolucion);

        $tratERepo = $orm->getRepository('NeurologiaBDBundle:TratamientoExterno');
        $tratE = $tratERepo->findByEvolucion($evolucion);

        $vars['tratinterno'] = $tratI;
        $vars['tratexterno'] = $tratE;
        $vars['diagnosticosDefinitivos'] = $diagD;
        $vars['diagnosticosPresuntivos'] = $diagP;
        $vars['estudios'] = $estudios;
        $vars['evolucion'] = $evolucion;

        return $this->render('EvolucionBundle:Evolucion:evolucion_modificar.html.twig', $vars);
    }
    
    public function descripcionEditAction()
    {
        $id = $_GET['id'];      
        
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NeurologiaBDBundle:Evolucion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Evolucion entity.');
        }

        $editForm = $this->descripcionCreateEditForm($entity);

        return $this->render('EvolucionBundle:Evolucion:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    private function descripcionCreateEditForm(Evolucion $entity)
    {
        $form = $this->createForm(new EvolucionType(), $entity, array(
            'action' => $this->generateUrl('evolucion_descripcion_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Modificar'));

        return $form;
    }

    public function descripcionUpdateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NeurologiaBDBundle:Evolucion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Evolucion entity.');
        }

        $editForm = $this->descripcionCreateEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();            
            return $this->redirect($this->generateUrl('neurologia_historia_clinica_homepage', array('accion' => 'evolucion_modificar', 'id' => $entity->getId(), 'tab' => 'Evolucion')));

        }

        return $this->render('EvolucionBundle:Evolucion:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }


}
