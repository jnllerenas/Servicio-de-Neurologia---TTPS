<?php

namespace Neurologia\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // add your custom field
        $builder->add('nombre');
        $builder->add('apellido');
        $builder->add('sexo');
        $builder->add('tipoDocumento');
        $builder->add('numero_documento');
        $builder->add('estadoCivil');
        $builder->add('telefono');
        $builder->add('fecha_de_nacimiento', 'date',array(
            'widget' => 'single_text'));
        $builder->add('direccion');
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
