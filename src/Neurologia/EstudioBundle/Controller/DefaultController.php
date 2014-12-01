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
            // ... maybe do some form processing, like saving the Task and Tag objects

            $em = $this->getDoctrine()->getManager();
            $imagenes=$estudio->getImagenes();
            foreach($imagenes as $value){
                $value->preupload();
                $value->upload();
            }
//            $evolucion=$em->merge($_SESSION['evolucion']);
//            $estudio->setEvolucion($evolucion);
            $_SESSION['estudios'][]=$estudio;
//            $em->persist($estudio);
//            $em->flush();
            return $this->redirect($this->generateUrl('evolucion_homepage_agregar'));
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
    
    public function listarAction(){        //HistoriaClinica $historiaClinica){
        
         
          

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
        if (!$estudios){ $estudios = array();}
//        else {
//            foreach ($estudios as $e) {
//                echo ($e->getFecha()->format('Y-m-d'));
//                
//            }
//        }
        
         return $this->render('NeurologiaEstudioBundle:Default:listar.html.twig', array(
                    'estudios' => $estudios));
    }
   

    
        public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('NeurologiaBDBundle:Estudio')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find estudio entity.');
        }          

        
        return $this->render('NeurologiaEstudioBundle:Default:show.html.twig', array('estudio' => $entity));
    }
   

}
