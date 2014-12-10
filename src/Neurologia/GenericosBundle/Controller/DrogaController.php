<?php

namespace Neurologia\GenericosBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Neurologia\BDBundle\Entity\Droga;
use Neurologia\GenericosBundle\Form\DrogaType;

/**
 * Droga controller.
 *
 */
class DrogaController extends Controller
{

    /**
     * Lists all Droga entities.
     *
     */
    public function indexAction($error=null, $msj=null)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('NeurologiaBDBundle:Droga')->findAll();
        
        if(!empty($msj)){
            $this->get('session')
                ->getFlashBag()
                ->add(
                    'mensaje', $msj
                );
            return $this->redirect($this->generateUrl('droga', array(
                'entities' => $entities
            )));
        }
        if(!empty($error)){
            $this->get('session')
                ->getFlashBag()
                ->add(
                    'error', $error
                );
            return $this->redirect($this->generateUrl('droga', array(
                'entities' => $entities
            )));
        }
        
        return $this->render('NeurologiaGenericosBundle:Droga:index.html.twig', array(
            'entities' => $entities
        ));              

    }
    /**
     * Creates a new Droga entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Droga();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            try {
                $em->flush();
            }
            catch (\Doctrine\DBAL\DBALException $e) {
                if ($e->getCode() == 0){
                    if ($e->getPrevious()->getCode() == 23000){
                        return $this->forward('NeurologiaGenericosBundle:Droga:index', array('error'=>'No puede haber dos drogas con la misma descripción'));
                    }
                    else{
                        throw $e;
                    }
                }else{
                    throw $e;
                }
            }

            return $this->forward('NeurologiaGenericosBundle:Droga:index', array('msj'=>'Registro creado satisfactoriamente'));
        }

        return $this->render('NeurologiaGenericosBundle:Droga:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Droga entity.
     *
     * @param Droga $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Droga $entity)
    {
        $form = $this->createForm(new DrogaType(), $entity, array(
            'action' => $this->generateUrl('droga_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear', 'attr' => array('class' => 'btn btn-success',)));

        return $form;
    }

    /**
     * Displays a form to create a new Droga entity.
     *
     */
    public function newAction()
    {
        $entity = new Droga();
        $form   = $this->createCreateForm($entity);

        return $this->render('NeurologiaGenericosBundle:Droga:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Droga entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NeurologiaBDBundle:Droga')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No se ha podido encontrar la droga seleccionada.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('NeurologiaGenericosBundle:Droga:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Droga entity.
    *
    * @param Droga $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Droga $entity)
    {
        $form = $this->createForm(new DrogaType(), $entity, array(
            'action' => $this->generateUrl('droga_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar', 'attr' => array('class' => 'btn btn-success',)));

        return $form;
    }
    /**
     * Edits an existing Droga entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NeurologiaBDBundle:Droga')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No se ha podido encontrar la droga seleccionada.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            try {
				$em->flush();
			}
			catch (\Doctrine\DBAL\DBALException $e) {
				if ($e->getCode() == 0){
					if ($e->getPrevious()->getCode() == 23000){
						return $this->forward('NeurologiaGenericosBundle:Droga:index', array('error'=>'No puede haber dos drogas con la misma descripción.'));
					}
					else{
						throw $e;
					}
				}
				else{
					throw $e;
				}
			}
			
			return $this->forward('NeurologiaGenericosBundle:Droga:index', array('msj'=>'Registro modificado satisfactoriamente'));
            //return $this->redirect($this->generateUrl('droga_edit', array('id' => $id)));
        }

        return $this->render('NeurologiaGenericosBundle:Droga:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Droga entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('NeurologiaBDBundle:Droga')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('No se ha podido encontrar la droga seleccionada.');
            }

            $em->remove($entity);
            
			try {	
				$em->flush();
				
			} catch (\Doctrine\DBAL\DBALException $e) {
				if ($e->getCode() == 0){
					if ($e->getPrevious()->getCode() == 23000){
						return $this->forward('NeurologiaGenericosBundle:Droga:index', array('error'=>'No se puede eliminar una droga utilizada en una Historia Clínica'));
					}
					else{
						throw $e;
					}
				}
				else{
					throw $e;
				}
			}				
		}

        return $this->forward('NeurologiaGenericosBundle:Droga:index', array('msj'=>'Registro eliminado satisfactoriamente'));
    }

    /**
     * Creates a form to delete a Droga entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('droga_delete', array('id' => $id)))
            ->setMethod('POST')
            ->add('submit', 'submit', array('label' => 'Borrar', 'attr' => array('class' => 'btn btn-danger',)))
            ->getForm()
        ;
    }
}
