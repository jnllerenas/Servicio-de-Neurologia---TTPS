<?php

namespace Neurologia\PacientesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PacienteType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
       
        $builder->add('nombre', 'text');
        $builder->add('apellido', 'text');
        $builder->add('direccion', 'text');
        $builder->add('documento', 'text');
        $builder->add('fechaNacimiento', 'birthday');
        $builder->add('telefono', 'text');
        $builder->add('ocupacion', 'text');
        $builder->add('otros', 'textarea');
        $builder->add('numeroCarnet', 'text');
        $builder->add('email', 'email');
        $builder->add('nivelEducacional');
        $builder->add('obraSocial');
        $builder->add('estadoCivil');
        $builder->add('tipoDocumento');
        $builder->add('admitidoPor');
        $builder->add('derivadoPor');
        $builder->add('sexo');
        //$builder->add('save', 'submit', array('label' => 'Alta paciente'));
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
