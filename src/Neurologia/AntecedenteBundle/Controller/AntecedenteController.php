<?php

namespace Neurologia\AntecedenteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Neurologia\BDBundle\Entity\Antecedente;
use Neurologia\AntecedenteBundle\Form\AntecedenteType;

/**
 * Antecedente controller.
 *
 */
class AntecedenteController extends Controller
{

    /**
     * Lists all Antecedente entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('NeurologiaAntecedenteBundle:Antecedente')->findAll();

        return $this->render('NeurologiaAntecedenteBundle:Antecedente:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Antecedente entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Antecedente();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('antecedente_show', array('id' => $entity->getId())));
        }

        return $this->render('NeurologiaAntecedenteBundle:Antecedente:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Antecedente entity.
     *
     * @param Antecedente $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Antecedente $entity)
    {
        $form = $this->createForm(new AntecedenteType(), $entity, array(
            'action' => $this->generateUrl('antecedente_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Antecedente entity.
     *
     */
    public function newAction()
    {
        $entity = new Antecedente();
        $form   = $this->createCreateForm($entity);

        return $this->render('NeurologiaAntecedenteBundle:Antecedente:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Antecedente entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NeurologiaAntecedenteBundle:Antecedente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Antecedente entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('NeurologiaAntecedenteBundle:Antecedente:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Antecedente entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NeurologiaAntecedenteBundle:Antecedente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Antecedente entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('NeurologiaAntecedenteBundle:Antecedente:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Antecedente entity.
    *
    * @param Antecedente $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Antecedente $entity)
    {
        $form = $this->createForm(new AntecedenteType(), $entity, array(
            'action' => $this->generateUrl('antecedente_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Antecedente entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NeurologiaAntecedenteBundle:Antecedente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Antecedente entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('antecedente_edit', array('id' => $id)));
        }

        return $this->render('NeurologiaAntecedenteBundle:Antecedente:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Antecedente entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('NeurologiaAntecedenteBundle:Antecedente')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Antecedente entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('antecedente'));
    }

    /**
     * Creates a form to delete a Antecedente entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('antecedente_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
