<?php

namespace Neurologia\AntecedenteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AntecedenteType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('descripcion', 'text', array('max_length' => '40'))
            ->add('tipoAntecedente', NULL,array(
                'expanded' => 'true',
                'empty_value'=>false,
                'required'=>true))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Neurologia\BDBundle\Entity\Antecedente'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'neurologia_bdbundle_antecedente';
    }
}
