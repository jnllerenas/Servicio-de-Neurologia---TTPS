<?php

namespace Neurologia\EstudioBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EstudioType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->add('descripcion');
        $builder->add('fecha');
        $builder->add('institucion');
        $builder->add('tipoEstudio');
        $builder->add('imagenes', 'collection', array(
            'label' => false,
            'type' => new ImagenType(),
            'allow_add' => true,
            'by_reference' => false,
            'allow_delete' => true,
            'prototype' => true,            
        ));
        $builder->add('save', 'submit', array('label' => 'Crear estudio'));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Neurologia\BDBundle\Entity\Estudio',
        ));
    }

    public function getName() {
        return 'estudio';
    }

}
