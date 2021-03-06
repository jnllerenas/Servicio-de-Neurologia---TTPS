<?php

namespace Neurologia\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class UserEditFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder->add('nombre', 'text', array( 'attr' => array( 'class' => 'form-control', 'maxlength' => '25')));
        $builder->add('apellido', 'text', array( 'attr' => array( 'class' => 'form-control', 'maxlength' => '25')));
        $builder->add('sexo',null, array( 'attr' => array( 'class' => 'form-control')));
        $builder->add('tipoDocumento',null, array( 'attr' => array( 'class' => 'form-control')));
        $builder->add('numero_documento','text', array( 'attr' => array( 'class' => 'form-control', 'maxlength' => '12')));
        $builder->add('estadoCivil',null, array( 'attr' => array( 'class' => 'form-control')));
        $builder->add('telefono','text', array( 'attr' => array( 'class' => 'form-control', 'maxlength' => '15')));
        $builder->add('fecha_de_nacimiento', 'date',array(
                                                        'widget' => 'single_text',
                                                        'attr' => array( 'class' => 'form-control')));
        $builder->add('direccion','text', array( 'attr' => array( 'class' => 'form-control', 'maxlength' => '25')));
        $builder->add('email', 'email', array( 
                                            'label' => 'form.email',
                                            'attr' => array( 'class' => 'form-control', 'maxlength' => '35'),
                                            'translation_domain' => 'FOSUserBundle'));
            
            
                   
    }

    public function getParent()
    {
        return 'fos_user_registration';
    }

    public function getName()
    {
        return 'neurologia_user_edit';
    }
}
