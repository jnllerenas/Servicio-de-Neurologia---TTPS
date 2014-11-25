<?php

namespace Neurologia\BusquedaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Neurologia\BDBundle\EfectoAdverso;

class AvanzadaType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
       
        $builder->add('categoriaDiagnostico', 'entity', array(
            'empty_value' => 'Elija un diagnóstico',
            'required' => false,
            'class' => 'NeurologiaBDBundle:CategoriaDiagnostico',
            'property' => 'descripcion',
        ));
        $builder->add('droga', 'entity', array(
            'empty_value' => 'Elija una droga',
            'required' => false,
            'class' => 'NeurologiaBDBundle:Droga',
            'property' => 'descripcion',
        ));
        $builder->add('sexo', 'entity', array(
            'required' => false,
            'class' => 'NeurologiaBDBundle:Sexo',
            'property' => 'descripcion',
        ));
        $builder->add('edad', 'integer',array(
            'required' => false,
            'attr'=>['max'=>'120', 'min' => '0']
        ));
        $builder->add('efectoAdverso', 'entity', array(
            'empty_value' => 'Elija un efecto adverso',
            'required' => false,
            'class' => 'NeurologiaBDBundle:EfectoAdverso',
            'property' => 'descripcion',
        ));
        $builder->add('search', 'submit', array('label' => 'Buscar'));
        $builder->add('reset', 'reset', array('label' => 'Limpiar'));


    }
   public function getName() {
        return 'avanzada';
    }
    
        public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array());
    }

}