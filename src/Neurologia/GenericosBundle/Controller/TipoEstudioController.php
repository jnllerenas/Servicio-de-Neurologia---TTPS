<?php

namespace Neurologia\GenericosBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Neurologia\GenericosBundle\Entity\TipoEstudio;
use Neurologia\GenericosBundle\Form\TipoEstudioType;

/**
 * TipoEstudio controller.
 *
 */
class TipoEstudioController extends Controller
{

    /**
     * Lists all TipoEstudio entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('NeurologiaGenericosBundle:TipoEstudio')->findAll();

        return $this->render('NeurologiaGenericosBundle:TipoEstudio:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new TipoEstudio entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new TipoEstudio();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tipoestudio_show', array('id' => $entity->getId())));
        }

        return $this->render('NeurologiaGenericosBundle:TipoEstudio:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a TipoEstudio entity.
     *
     * @param TipoEstudio $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TipoEstudio $entity)
    {
        $form = $this->createForm(new TipoEstudioType(), $entity, array(
            'action' => $this->generateUrl('tipoestudio_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new TipoEstudio entity.
     *
     */
    public function newAction()
    {
        $entity = new TipoEstudio();
        $form   = $this->createCreateForm($entity);

        return $this->render('NeurologiaGenericosBundle:TipoEstudio:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a TipoEstudio entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NeurologiaGenericosBundle:TipoEstudio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoEstudio entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('NeurologiaGenericosBundle:TipoEstudio:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing TipoEstudio entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NeurologiaGenericosBundle:TipoEstudio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoEstudio entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('NeurologiaGenericosBundle:TipoEstudio:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a TipoEstudio entity.
    *
    * @param TipoEstudio $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TipoEstudio $entity)
    {
        $form = $this->createForm(new TipoEstudioType(), $entity, array(
            'action' => $this->generateUrl('tipoestudio_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing TipoEstudio entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NeurologiaGenericosBundle:TipoEstudio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoEstudio entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('tipoestudio_edit', array('id' => $id)));
        }

        return $this->render('NeurologiaGenericosBundle:TipoEstudio:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a TipoEstudio entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('NeurologiaGenericosBundle:TipoEstudio')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TipoEstudio entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tipoestudio'));
    }

    /**
     * Creates a form to delete a TipoEstudio entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tipoestudio_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
