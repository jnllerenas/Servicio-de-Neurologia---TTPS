<?php

namespace Neurologia\GenericosBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Neurologia\BDBundle\Entity\TipoDocumento;
use Neurologia\GenericosBundle\Form\TipoDocumentoType;

/**
 * TipoDocumento controller.
 *
 */
class TipoDocumentoController extends Controller
{

    /**
     * Lists all TipoDocumento entities.
     *
     */
    public function indexAction($error=null, $msj=null)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('NeurologiaBDBundle:TipoDocumento')->findAll();

        return $this->render('NeurologiaGenericosBundle:TipoDocumento:index.html.twig', array(
            'entities' => $entities,
			'error'=>$error,
			'msj'=>$msj,
        ));
    }
    /**
     * Creates a new TipoDocumento entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new TipoDocumento();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

			return $this->forward('NeurologiaGenericosBundle:TipoDocumento:index', array('msj'=>'Registro creado satisfactoriamente'));
            //return $this->redirect($this->generateUrl('tipodocumento_show', array('id' => $entity->getId())));
        }

        return $this->render('NeurologiaGenericosBundle:TipoDocumento:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a TipoDocumento entity.
     *
     * @param TipoDocumento $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TipoDocumento $entity)
    {
        $form = $this->createForm(new TipoDocumentoType(), $entity, array(
            'action' => $this->generateUrl('tipodocumento_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear', 'attr' => array('class' => 'btn btn-success',)));

        return $form;
    }

    /**
     * Displays a form to create a new TipoDocumento entity.
     *
     */
    public function newAction()
    {
        $entity = new TipoDocumento();
        $form   = $this->createCreateForm($entity);

        return $this->render('NeurologiaGenericosBundle:TipoDocumento:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a TipoDocumento entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NeurologiaBDBundle:TipoDocumento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoDocumento entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('NeurologiaGenericosBundle:TipoDocumento:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing TipoDocumento entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NeurologiaBDBundle:TipoDocumento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoDocumento entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('NeurologiaGenericosBundle:TipoDocumento:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a TipoDocumento entity.
    *
    * @param TipoDocumento $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TipoDocumento $entity)
    {
        $form = $this->createForm(new TipoDocumentoType(), $entity, array(
            'action' => $this->generateUrl('tipodocumento_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar', 'attr' => array('class' => 'btn btn-success',)));

        return $form;
    }
    /**
     * Edits an existing TipoDocumento entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NeurologiaBDBundle:TipoDocumento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoDocumento entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

			return $this->forward('NeurologiaGenericosBundle:TipoDocumento:index', array('msj'=>'Registro modificado satisfactoriamente'));
            //return $this->redirect($this->generateUrl('tipodocumento_edit', array('id' => $id)));
        }

        return $this->render('NeurologiaGenericosBundle:TipoDocumento:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a TipoDocumento entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('NeurologiaBDBundle:TipoDocumento')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TipoDocumento entity.');
            }

            $em->remove($entity);
            
			try {	
				$em->flush();
				
			} catch (\Doctrine\DBAL\DBALException $e) {
				if ($e->getCode() == 0){
					if ($e->getPrevious()->getCode() == 23000){
						return $this->forward('NeurologiaGenericosBundle:TipoDocumento:index', array('error'=>'Imposible eliminar por integridad referencial'));
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

        return $this->forward('NeurologiaGenericosBundle:TipoDocumento:index', array('msj'=>'Registro eliminado satisfactoriamente'));
    }

    /**
     * Creates a form to delete a TipoDocumento entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tipodocumento_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar', 'attr' => array('class' => 'btn btn-danger',)))
            ->getForm()
        ;
    }
}
