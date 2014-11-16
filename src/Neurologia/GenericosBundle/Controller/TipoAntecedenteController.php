<?php

namespace Neurologia\GenericosBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Neurologia\BDBundle\Entity\TipoAntecedente;
use Neurologia\GenericosBundle\Form\TipoAntecedenteType;

/**
 * TipoAntecedente controller.
 *
 */
class TipoAntecedenteController extends Controller
{

    /**
     * Lists all TipoAntecedente entities.
     *
     */
    public function indexAction($error=null, $msj=null)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('NeurologiaBDBundle:TipoAntecedente')->findAll();

        return $this->render('NeurologiaGenericosBundle:TipoAntecedente:index.html.twig', array(
            'entities' => $entities,
			'error'=>$error,
			'msj'=>$msj,
        ));
    }
    /**
     * Creates a new TipoAntecedente entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new TipoAntecedente();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

			return $this->forward('NeurologiaGenericosBundle:TipoAntecedente:index', array('msj'=>'Registro creado satisfactoriamente'));
            //return $this->redirect($this->generateUrl('tipoantecedente_show', array('id' => $entity->getId())));
        }

        return $this->render('NeurologiaGenericosBundle:TipoAntecedente:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a TipoAntecedente entity.
     *
     * @param TipoAntecedente $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TipoAntecedente $entity)
    {
        $form = $this->createForm(new TipoAntecedenteType(), $entity, array(
            'action' => $this->generateUrl('tipoantecedente_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear', 'attr' => array('class' => 'btn btn-success',)));

        return $form;
    }

    /**
     * Displays a form to create a new TipoAntecedente entity.
     *
     */
    public function newAction()
    {
        $entity = new TipoAntecedente();
        $form   = $this->createCreateForm($entity);

        return $this->render('NeurologiaGenericosBundle:TipoAntecedente:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a TipoAntecedente entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NeurologiaBDBundle:TipoAntecedente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoAntecedente entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('NeurologiaGenericosBundle:TipoAntecedente:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing TipoAntecedente entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NeurologiaBDBundle:TipoAntecedente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoAntecedente entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('NeurologiaGenericosBundle:TipoAntecedente:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a TipoAntecedente entity.
    *
    * @param TipoAntecedente $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TipoAntecedente $entity)
    {
        $form = $this->createForm(new TipoAntecedenteType(), $entity, array(
            'action' => $this->generateUrl('tipoantecedente_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar', 'attr' => array('class' => 'btn btn-success',)));

        return $form;
    }
    /**
     * Edits an existing TipoAntecedente entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NeurologiaBDBundle:TipoAntecedente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoAntecedente entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

			return $this->forward('NeurologiaGenericosBundle:TipoAntecedente:index', array('msj'=>'Registro modificado satisfactoriamente'));
            //return $this->redirect($this->generateUrl('tipoantecedente_edit', array('id' => $id)));
        }

        return $this->render('NeurologiaGenericosBundle:TipoAntecedente:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a TipoAntecedente entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('NeurologiaBDBundle:TipoAntecedente')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TipoAntecedente entity.');
            }

            $em->remove($entity);
            
			try {	
				$em->flush();
				
			} catch (\Doctrine\DBAL\DBALException $e) {
				if ($e->getCode() == 0){
					if ($e->getPrevious()->getCode() == 23000){
						return $this->forward('NeurologiaGenericosBundle:TipoAntecedente:index', array('error'=>'Imposible eliminar por integridad referencial'));
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

        return $this->forward('NeurologiaGenericosBundle:TipoAntecedente:index', array('msj'=>'Registro eliminado satisfactoriamente'));
    }

    /**
     * Creates a form to delete a TipoAntecedente entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tipoantecedente_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar', 'attr' => array('class' => 'btn btn-danger',)))
            ->getForm()
        ;
    }
}
