<?php

namespace Neurologia\BusquedaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UsuarioType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
       
        $builder->add('nombre', 'text', array(
            'required'  => false
        ));
        $builder->add('apellido', 'text', array(
            'required'  => false
        ));
        $builder->add('documento', 'text', array(
            'required'  => false
        ));
        $builder->add('usuario', 'text', array(
            'required'  => false
        ));
        $builder->add('activo', 'choice', array(
            'required'  => false,
            'empty_value' => 'Todos',
            'choices' => array( '1' => 'Activo' , '0'=>'Inactivo')
        ));
        $builder->add('search', 'submit', array('label' => 'Buscar'));
        $builder->add('reset', 'reset', array('label' => 'Limpiar'));


    }

   public function getName() {
        return 'usuario';
    }
    
        public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Neurologia\BDBundle\Entity\User',
        ));
    }

}