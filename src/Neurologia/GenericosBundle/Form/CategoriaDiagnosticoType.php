<?php

namespace Neurologia\GenericosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CategoriaDiagnosticoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('descripcion', 'text', array('max_length' => '40'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Neurologia\BDBundle\Entity\CategoriaDiagnostico'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'neurologia_genericosbundle_categoriadiagnostico';
    }
}
