<?php

namespace Neurologia\GenericosBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Neurologia\BDBundle\Entity\ObraSocial;
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
    public function indexAction($error=null, $msj=null)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('NeurologiaBDBundle:ObraSocial')->findAll();

        if(!empty($msj)){
            $this->get('session')
                ->getFlashBag()
                ->add(
                    'mensaje', $msj
                );
            return $this->redirect($this->generateUrl('obrasocial', array(
                'entities' => $entities
            )));
        }
        if(!empty($error)){
            $this->get('session')
                ->getFlashBag()
                ->add(
                    'error', $error
                );
            return $this->redirect($this->generateUrl('obrasocial', array(
                'entities' => $entities
            )));
        }
        
        return $this->render('NeurologiaGenericosBundle:ObraSocial:index.html.twig', array(
            'entities' => $entities
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
            try {
                $em->flush();
            }
            catch (\Doctrine\DBAL\DBALException $e) {
                if ($e->getCode() == 0){
                    if ($e->getPrevious()->getCode() == 23000){
                        return $this->forward('NeurologiaGenericosBundle:ObraSocial:index', array('error'=>'No puede haber dos obras sociales con la misma descripción.'));
                    }
                    else{
                        throw $e;
                    }
                }
                else{
                    throw $e;
                }
            }

            return $this->forward('NeurologiaGenericosBundle:ObraSocial:index', array('msj'=>'Registro creado satisfactoriamente'));
            
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

        $form->add('submit', 'submit', array('label' => 'Crear', 'attr' => array('class' => 'btn btn-success',)));

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
     * Displays a form to edit an existing ObraSocial entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NeurologiaBDBundle:ObraSocial')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No se ha podido encontrar la obra social seleccionada.');
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

        $form->add('submit', 'submit', array('label' => 'Actualizar', 'attr' => array('class' => 'btn btn-success',)));

        return $form;
    }
    /**
     * Edits an existing ObraSocial entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NeurologiaBDBundle:ObraSocial')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No se ha podido encontrar la obra social seleccionada.');
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
						return $this->forward('NeurologiaGenericosBundle:ObraSocial:index', array('error'=>'No puede haber dos obras sociales con la misma descripción.'));
					}
					else{
						throw $e;
					}
				}
				else{
					throw $e;
				}
			}

			return $this->forward('NeurologiaGenericosBundle:ObraSocial:index', array('msj'=>'Registro modificado satisfactoriamente'));
            //return $this->redirect($this->generateUrl('obrasocial_edit', array('id' => $id)));
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
            $entity = $em->getRepository('NeurologiaBDBundle:ObraSocial')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('No se ha podido encontrar la obra social seleccionada.');
            }

            $em->remove($entity);
            
			try {	
				$em->flush();
				
			} catch (\Doctrine\DBAL\DBALException $e) {
				if ($e->getCode() == 0){
					if ($e->getPrevious()->getCode() == 23000){
						return $this->forward('NeurologiaGenericosBundle:ObraSocial:index', array('error'=>'No se puede eliminar una obra social utilizada en una Historia Clínica'));
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

        return $this->forward('NeurologiaGenericosBundle:ObraSocial:index', array('msj'=>'Registro eliminado satisfactoriamente'));
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
            ->setMethod('POST')
            ->add('submit', 'submit', array('label' => 'Borrar', 'attr' => array('class' => 'btn btn-danger',)))
            ->getForm()
        ;
    }
}
