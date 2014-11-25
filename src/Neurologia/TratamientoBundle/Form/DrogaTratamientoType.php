<?php

namespace Neurologia\TratamientoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Neurologia\BDBundle\Entity\Droga as Droga;
use Neurologia\BDBundle\Entity\EfectoAdverso as EfectoAdverso;

class DrogaTratamientoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $droga = new Droga();
        $efectoAdverso = new EfectoAdverso();
        
        $builder
            ->add('tratamiento', 'collection', array(
                        'label' => 'tratamientoo o o o o ',
                        'type' => new TratamientoInternoType(),
                        'allow_add' => true,
                        'by_reference' => false,
                        'allow_delete' => true,
                        'prototype' => true
            ))               
            ->add('droga', 'collection', array(
                        'label' => 'droga o o o o ',
                        'type' => new \Neurologia\GenericosBundle\Form\DrogaType(),
                        'allow_add' => true,
                        'by_reference' => false,
                        'allow_delete' => true,
                        'prototype' => true
            ))               
            ->add('efectoAdverso', 'collection', array(
                        'label' => 'efectoo o o o o ',
                        'type' => new \Neurologia\GenericosBundle\Form\EfectoAdversoType(),
                        'allow_add' => true,
                        'by_reference' => false,
                        'allow_delete' => true,
                        'prototype' => true
            ))               
            ->add('dosis', 'text')
            
            ->add('aceptar', 'submit', array('label' => 'Aceptar'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Neurologia\BDBundle\Entity\DrogaTratamiento'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'neurologia_tratamientobundle_drogatratamiento';
    }
}
