<?php

namespace Neurologia\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Neurologia\UserBundle\Form\DataTransformer\StringToArrayTransformer;
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;

class AdminEditFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $transformer = new StringToArrayTransformer();
        // add your custom field
        $builder->add('nombre', 'text', array( 'attr' => array( 'class' => 'form-control')));
        $builder->add('apellido', 'text', array( 'attr' => array( 'class' => 'form-control')));
        $builder->add('sexo',null, array( 'attr' => array( 'class' => 'form-control')));
        $builder->add('tipoDocumento',null, array( 'attr' => array( 'class' => 'form-control')));
        $builder->add('numero_documento',null, array( 'attr' => array( 'class' => 'form-control')));
        $builder->add('estadoCivil',null, array( 'attr' => array( 'class' => 'form-control')));
        $builder->add('telefono',null, array( 'attr' => array( 'class' => 'form-control')));
        $builder->add('fecha_de_nacimiento', 'date',array(
                                                        'widget' => 'single_text',
                                                        'attr' => array( 'class' => 'form-control')));
        $builder->add('direccion',null, array( 'attr' => array( 'class' => 'form-control')));
        
        $builder->add('username', 'text', array(
                                            'label' => 'Usuario',
                                            'attr' => array( 'class' => 'form-control'),
                                            'translation_domain' => 'FOSUserBundle'));
        $builder->add('enabled', 'choice',  array(
                                                'label' => 'Activo',
                                                'attr' => array( 'class' => 'form-control'),
                                                'required' => true,
                                                'choice_list' => new ChoiceList(array(true, false), array('Activo', 'Inactivo'))
                                            ));
        
        $builder->add($builder->create('roles', 'choice', array(
                                                            'label' => 'Rol',
                                                            'attr' => array( 'class' => 'form-control'),
                                                            'required' => true,
                                                            'mapped' => true,
                                                            'multiple' => false,
                                                            'choices' => array(
                                                                'ROLE_DOCTOR' => 'Médico',
                                                                'ROLE_SECRETARY' => 'Secretario',
                                                                'ROLE_ADMIN' => 'Administrador'
                                                            )
                                                          ))->addModelTransformer($transformer));
        $builder->add('email', 'email', array( 
                                            'label' => 'form.email',
                                            'attr' => array( 'class' => 'form-control'),
                                            'translation_domain' => 'FOSUserBundle'));
        $builder->add('plainPassword', 'repeated', array(
                        'type' => 'password',
                        'attr' => array( 'class' => 'form-control'),
                        'options' => array('translation_domain' => 'FOSUserBundle'),
                        'first_options' => array('label' => 'Contraseña'),
                        'second_options' => array('label' => 'Repetir contraseña'),
                        'invalid_message' => 'fos_user.password.mismatch'
                    )); 
            
            
                   
    }
        
    public function getParent()
    {
        return 'fos_user_registration';
    }

    public function getName()
    {
        return 'neurologia_admin_edit';
    }
}
