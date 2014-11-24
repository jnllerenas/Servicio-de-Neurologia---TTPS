<?php

namespace Neurologia\BusquedaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PacienteType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
       
        $builder->add('nombre', 'text',array(
            'required' => false));
        $builder->add('apellido', 'text',array(
            'required' => false));
        $builder->add('documento', 'number',array(
            'required' => false));
        $builder->add('telefono', 'number',array(
            'required' => false));
        $builder->add('fechaNacimiento', 'date',array(
            'widget' => 'single_text',
            'required' => false));
        $builder->add('search', 'submit', array('label' => 'Buscar'));
        $builder->add('reset', 'reset', array('label' => 'Limpiar'));


    }

   public function getName() {
        return 'paciente';
    }
    
        public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Neurologia\BDBundle\Entity\Paciente',
        ));
    }

}
