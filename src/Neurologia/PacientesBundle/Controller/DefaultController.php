<?php
namespace Neurologia\PacientesBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Neurologia\BDBundle\Entity\Paciente;
use Neurologia\PacientesBundle\Form\Type\PacienteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
class DefaultController extends Controller { 
    
     /**
     * Lists all Paciente entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('NeurologiaBDBundle:Paciente')->findAll();
        return $this->render('NeurologiaPacientesBundle:Default:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Paciente entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Paciente();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            return $this->redirect($this->generateUrl('neurologia_busqueda_paciente'));
        }
        return $this->render('NeurologiaPacientesBundle:Default:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
    /**
     * Creates a form to create a Paciente entity.
     *
     * @param Paciente $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Paciente $entity)
    {
        $form = $this->createForm(new PacienteType(), $entity, array(
            'action' => $this->generateUrl('paciente_create'),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'Registrar'));
        return $form;
    }
    /**
     * Displays a form to create a new Paciente entity.
     *
     */
    public function newAction()
    {
        $entity = new Paciente();
        $form   = $this->createCreateForm($entity);
        return $this->render('NeurologiaPacientesBundle:Default:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
    /**
     * Finds and displays a Paciente entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('NeurologiaBDBundle:Paciente')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Paciente entity.');
        }
        $deleteForm = $this->createDeleteForm($id);
        return $this->render('NeurologiaPacientesBundle:Default:show.html.twig', array(
            'estudio'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Displays a form to edit an existing Paciente entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('NeurologiaBDBundle:Paciente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Paciente entity.');
        }
        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);
        return $this->render('NeurologiaPacientesBundle:Default:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
    * Creates a form to edit a Paciente entity.
    *
    * @param Paciente $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Paciente $entity)
    {
        $form = $this->createForm(new PacienteType(), $entity, array(
            'action' => $this->generateUrl('paciente_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));
        $form->add('submit', 'submit', array('label' => 'Actualizar'));
        return $form;
    }
    /**
     * Edits an existing Paciente entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('NeurologiaBDBundle:Paciente')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Paciente entity.');
        }
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request); 
        if ($editForm->isValid()) {
            $em->flush();
            return $this->redirect($this->generateUrl('neurologia_busqueda_paciente'));
        }
        return $this->render('NeurologiaPacientesBundle:Default:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Paciente entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('NeurologiaBDBundle:Paciente')->find($id);
            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Paciente entity.');
            }
            $em->remove($entity);
            $em->flush();
        }
        return $this->redirect($this->generateUrl('paciente'));
    }
    /**
     * Creates a form to delete a Paciente entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('paciente_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar'))
            ->getForm()
        ;
    }
}