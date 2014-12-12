<?php

namespace Neurologia\TratamientoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TratamientoExternoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('descripcion', 'textarea', array('required'  => true, 'label' => 'Descripción','max_length'=>'80'))
            ->add('aceptar', 'submit', array('label' => 'Aceptar'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Neurologia\BDBundle\Entity\TratamientoExterno'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'neurologia_tratamientobundle_tratamientoexterno';
    }
}
