<?php

namespace Neurologia\EstudioBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EstudioType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->add('descripcion', 'textarea',array('max_length'=>'80','attr'=>array('class'=>'form-control')));
        $builder->add('fecha', 'date',array(
            'widget' => 'single_text'));
        $builder->add('institucion','text',array('max_length'=>'35','attr'=>array('class'=>'form-control')));
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
