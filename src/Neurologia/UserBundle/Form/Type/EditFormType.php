<?php

namespace Neurologia\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Neurologia\UserBundle\Form\DataTransformer\StringToArrayTransformer;
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;

class EditFormType extends AbstractType
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
        $builder->add('email', 'email', array( 
                                            'label' => 'form.email',
                                            'attr' => array( 'class' => 'form-control'),
                                            'translation_domain' => 'FOSUserBundle'));
            
            
                   
    }

    public function getParent()
    {
        return 'fos_user_registration';
    }

    public function getName()
    {
        return 'neurologia_user_registration';
    }
}
