<?php

namespace Neurologia\PacientesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PacienteType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
		
        $builder->add('nombre', 'text', array('attr'=>array('size'=>25)));
        $builder->add('apellido', 'text', array('attr'=>array('size'=>25)));
		$builder->add('sexo');
		$builder->add('tipoDocumento');
		$builder->add('documento', 'text', array('attr'=>array('size'=>10)));
        $builder->add('fechaNacimiento', 'date', array(
            'widget' => 'single_text'));
        $builder->add('telefono', 'text', array('attr'=>array('size'=>12)));
        
		$builder->add('direccion', 'text', array('required' => false, 'attr'=>array('size'=>15))); 
		$builder->add('email', 'email', array('required' => false, 'attr'=>array('size'=>15)));
        $builder->add('ocupacion', 'text', array('required' => false, 'attr'=>array('size'=>20)));
        $builder->add('otros', 'textarea', array('required' => false, 'attr'=>array('style'=>'height:34px')));
        $builder->add('numeroCarnet', 'text', array('attr'=>array('size'=>12)));
       
        $builder->add('estadoCivil');
		$builder->add('nivelEducacional');
        $builder->add('obraSocial');
        
        /*$builder->add('admitidoPor');*/
        $builder->add('derivadoPor');
        
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
