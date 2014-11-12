<?php

namespace Neurologia\GenericosBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Neurologia\GenericosBundle\Entity\EstadoCivil;
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
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('NeurologiaGenericosBundle:EstadoCivil')->findAll();

        return $this->render('NeurologiaGenericosBundle:EstadoCivil:index.html.twig', array(
            'entities' => $entities,
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
            $em->flush();

            return $this->redirect($this->generateUrl('estadocivil_show', array('id' => $entity->getId())));
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

        $form->add('submit', 'submit', array('label' => 'Create'));

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
     * Finds and displays a EstadoCivil entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NeurologiaGenericosBundle:EstadoCivil')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EstadoCivil entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('NeurologiaGenericosBundle:EstadoCivil:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing EstadoCivil entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NeurologiaGenericosBundle:EstadoCivil')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EstadoCivil entity.');
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

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing EstadoCivil entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NeurologiaGenericosBundle:EstadoCivil')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EstadoCivil entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('estadocivil_edit', array('id' => $id)));
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
            $entity = $em->getRepository('NeurologiaGenericosBundle:EstadoCivil')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find EstadoCivil entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('estadocivil'));
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
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
