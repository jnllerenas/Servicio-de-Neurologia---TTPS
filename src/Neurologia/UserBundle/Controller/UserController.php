<?php

namespace Neurologia\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Neurologia\BDBundle\Entity\User;
use Neurologia\UserBundle\Form\Type\UserEditFormType;
/**
 * User controller.
 *
 */
class UserController extends Controller
{

    /**
     * Lists all User entities.
     *
     */
    public function indexAction()
    {
    }

    /**
     * Displays a form to edit an existing User entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NeurologiaBDBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No se pudo encontrar al usuario seleccionado.');
        }

        $editForm = $this->createEditForm($entity);

        return $this->render('NeurologiaUserBundle:User:userEdit.html.twig', array(
            'entity' => $entity,
            'form'   => $editForm->createView()
        ));
    }
    
    /**
    * Creates a form to edit a User entity.
    *
    * @param User $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(User $entity)
    {
        $form = $this->createForm(new UserEditFormType(), $entity, array(
            'action' => $this->generateUrl('user_update', array('id' => $entity->getId())),
            'method' => 'POST',
        ))->remove('plainPassword')->remove('username');

        $form->add('submit', 'submit', array('label' => 'Actualizar'));

        return $form;
    }
    /**
     * Edits an existing User entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NeurologiaBDBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No se pudo encontrar al usuario seleccionado.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'mensaje', 'Se ha modificado exitosamente el usuario.'
            );
            return $this->redirect($this->generateUrl('neurologia_main_homepage'));
        }

        return $this->render('NeurologiaUserBundle:User:userEdit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView()
        ));
    }

}
