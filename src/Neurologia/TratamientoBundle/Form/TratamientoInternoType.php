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
            ->add('descripcion', 'textarea', array('required'  => true, 'label' => 'Descripción','max_length'=>'80'))
            ->add('inicio', 'date', array('required'  => true, 
                                          'label' => 'Fecha de inicio',
                                            'widget' => 'single_text'))
            ->add('activo', 'choice', array('choices'   => array('1' => 'Si', '0' => 'No'),
                                            'required'  => true,
                                            'label' => 'Está activo?'))
            ->add('drogaTratamiento', 'collection', array(
            'label' => false,
            'type' => new DrogaTratamientoType(),
            'allow_add' => true,
            'by_reference' => false,
            'allow_delete' => true,
            'prototype' => true,            
        ))
            ->add('aceptar', 'submit', array('label' => 'Guardar'))
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
        return 'neurologia_tratamientobundle_tratamientointerno';
    }
}
