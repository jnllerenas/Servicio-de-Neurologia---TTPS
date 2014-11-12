<?php

namespace Neurologia\GenericosBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Neurologia\GenericosBundle\Entity\Droga;
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
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('NeurologiaGenericosBundle:Droga')->findAll();

        return $this->render('NeurologiaGenericosBundle:Droga:index.html.twig', array(
            'entities' => $entities,
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
            $em->flush();

            return $this->redirect($this->generateUrl('droga_show', array('id' => $entity->getId())));
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

        $form->add('submit', 'submit', array('label' => 'Create'));

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
     * Finds and displays a Droga entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NeurologiaGenericosBundle:Droga')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Droga entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('NeurologiaGenericosBundle:Droga:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Droga entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NeurologiaGenericosBundle:Droga')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Droga entity.');
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

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Droga entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NeurologiaGenericosBundle:Droga')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Droga entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('droga_edit', array('id' => $id)));
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
            $entity = $em->getRepository('NeurologiaGenericosBundle:Droga')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Droga entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('droga'));
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
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
