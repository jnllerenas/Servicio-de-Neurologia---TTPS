<?php

namespace Neurologia\BusquedaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PacienteType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
       
        $builder->add('nombre', 'text');
        $builder->add('apellido', 'text');
        $builder->add('documento', 'text');
        $builder->add('telefono', 'text');
        $builder->add('fechaNacimiento', 'birthday');
        $builder->add('save', 'submit', array('label' => 'Buscar'));
        $builder->add('save', 'button', array('label' => 'Limpiar'));


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
