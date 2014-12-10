<?php

namespace Neurologia\GenericosBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Neurologia\BDBundle\Entity\EstadoCivil;
use Neurologia\GenericosBundle\Form\EstadoCivilType;

/**
 * EstadoCivil controller.
 *
 */
class EstadoCivilController extends Controller
{

    /**
     * Lists all EstadoCivil entities.
     *
     */
    public function indexAction($error=null, $msj=null)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('NeurologiaBDBundle:EstadoCivil')->findAll();

        if(!empty($msj)){
            $this->get('session')
                ->getFlashBag()
                ->add(
                    'mensaje', $msj
                );
            return $this->redirect($this->generateUrl('estadocivil', array(
                'entities' => $entities
            )));
        }
        if(!empty($error)){
            $this->get('session')
                ->getFlashBag()
                ->add(
                    'error', $error
                );
            return $this->redirect($this->generateUrl('estadocivil', array(
                'entities' => $entities
            )));
        }
        
        return $this->render('NeurologiaGenericosBundle:EstadoCivil:index.html.twig', array(
            'entities' => $entities
        ));      
       
    }
    /**
     * Creates a new EstadoCivil entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new EstadoCivil();
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
                        return $this->forward('NeurologiaGenericosBundle:EstadoCivil:index', array('error'=>'No puede haber dos estados civiles con la misma descripción.'));
                    }
                    else{
                        throw $e;
                    }
                }else{
                    throw $e;
                }
            }

            return $this->forward('NeurologiaGenericosBundle:EstadoCivil:index', array('msj'=>'Registro creado satisfactoriamente'));
            //return $this->redirect($this->generateUrl('estadocivil_show', array('id' => $entity->getId())));
        }

        return $this->render('NeurologiaGenericosBundle:EstadoCivil:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a EstadoCivil entity.
     *
     * @param EstadoCivil $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(EstadoCivil $entity)
    {
        $form = $this->createForm(new EstadoCivilType(), $entity, array(
            'action' => $this->generateUrl('estadocivil_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear', 'attr' => array('class' => 'btn btn-success',)));

        return $form;
    }

    /**
     * Displays a form to create a new EstadoCivil entity.
     *
     */
    public function newAction()
    {
        $entity = new EstadoCivil();
        $form   = $this->createCreateForm($entity);

        return $this->render('NeurologiaGenericosBundle:EstadoCivil:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing EstadoCivil entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NeurologiaBDBundle:EstadoCivil')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No se ha podido encontrar el estado civil seleccionado.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('NeurologiaGenericosBundle:EstadoCivil:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a EstadoCivil entity.
    *
    * @param EstadoCivil $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(EstadoCivil $entity)
    {
        $form = $this->createForm(new EstadoCivilType(), $entity, array(
            'action' => $this->generateUrl('estadocivil_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar', 'attr' => array('class' => 'btn btn-success',)));

        return $form;
    }
    /**
     * Edits an existing EstadoCivil entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NeurologiaBDBundle:EstadoCivil')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No se ha podido encontrar el estado civil seleccionado.');
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
						return $this->forward('NeurologiaGenericosBundle:EstadoCivil:index', array('error'=>'No puede haber dos estados civiles con la misma descripción.'));
					}
					else{
						throw $e;
					}
				}
				else{
					throw $e;
				}
			}
	
			return $this->forward('NeurologiaGenericosBundle:EstadoCivil:index', array('msj'=>'Registro modificado satisfactoriamente'));
            //return $this->redirect($this->generateUrl('estadocivil_edit', array('id' => $id)));
        }

        return $this->render('NeurologiaGenericosBundle:EstadoCivil:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a EstadoCivil entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('NeurologiaBDBundle:EstadoCivil')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('No se ha podido encontrar el estado civil seleccionado.');
            }

            $em->remove($entity);
            
			try {	
				$em->flush();
				
			} catch (\Doctrine\DBAL\DBALException $e) {
				if ($e->getCode() == 0){
					if ($e->getPrevious()->getCode() == 23000){
						return $this->forward('NeurologiaGenericosBundle:EstadoCivil:index', array('error'=>'No se puede eliminar un estado civil utilizado en una Historia Clínica'));
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

        return $this->forward('NeurologiaGenericosBundle:EstadoCivil:index', array('msj'=>'Registro eliminado satisfactoriamente'));
    }

    /**
     * Creates a form to delete a EstadoCivil entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('estadocivil_delete', array('id' => $id)))
            ->setMethod('POST')
            ->add('submit', 'submit', array('label' => 'Borrar', 'attr' => array('class' => 'btn btn-danger',)))
            ->getForm()
        ;
    }
}
