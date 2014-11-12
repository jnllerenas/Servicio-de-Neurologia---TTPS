<?php

namespace Neurologia\GenericosBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Neurologia\GenericosBundle\Entity\ObraSocial;
use Neurologia\GenericosBundle\Form\ObraSocialType;

/**
 * ObraSocial controller.
 *
 */
class ObraSocialController extends Controller
{

    /**
     * Lists all ObraSocial entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('NeurologiaGenericosBundle:ObraSocial')->findAll();

        return $this->render('NeurologiaGenericosBundle:ObraSocial:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new ObraSocial entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new ObraSocial();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('obrasocial_show', array('id' => $entity->getId())));
        }

        return $this->render('NeurologiaGenericosBundle:ObraSocial:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a ObraSocial entity.
     *
     * @param ObraSocial $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(ObraSocial $entity)
    {
        $form = $this->createForm(new ObraSocialType(), $entity, array(
            'action' => $this->generateUrl('obrasocial_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new ObraSocial entity.
     *
     */
    public function newAction()
    {
        $entity = new ObraSocial();
        $form   = $this->createCreateForm($entity);

        return $this->render('NeurologiaGenericosBundle:ObraSocial:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ObraSocial entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NeurologiaGenericosBundle:ObraSocial')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ObraSocial entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('NeurologiaGenericosBundle:ObraSocial:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ObraSocial entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NeurologiaGenericosBundle:ObraSocial')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ObraSocial entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('NeurologiaGenericosBundle:ObraSocial:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a ObraSocial entity.
    *
    * @param ObraSocial $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ObraSocial $entity)
    {
        $form = $this->createForm(new ObraSocialType(), $entity, array(
            'action' => $this->generateUrl('obrasocial_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing ObraSocial entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NeurologiaGenericosBundle:ObraSocial')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ObraSocial entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('obrasocial_edit', array('id' => $id)));
        }

        return $this->render('NeurologiaGenericosBundle:ObraSocial:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a ObraSocial entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('NeurologiaGenericosBundle:ObraSocial')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ObraSocial entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('obrasocial'));
    }

    /**
     * Creates a form to delete a ObraSocial entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('obrasocial_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
