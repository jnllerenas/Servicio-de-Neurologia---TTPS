<?php

namespace Neurologia\TratamientoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TratamientoInternoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('descripcion', 'textarea', array('required'  => true, 'label' => 'Descripción'))
            ->add('inicio', 'date', array('required'  => true, 'label' => 'Fecha de inicio'))
            ->add('activo', 'choice', array('choices'   => array('1' => 'Si', '0' => 'No'),
                                            'required'  => true,
                                            'label' => 'Está activo?'))
            ->add('aceptar', 'submit', array('label' => 'Aceptar'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Neurologia\BDBundle\Entity\TratamientoInterno'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'neurologia_bdbundle_tratamientointerno';
    }
}
