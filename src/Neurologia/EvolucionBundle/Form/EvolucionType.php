<?php

namespace Neurologia\EvolucionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EvolucionType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('evolucion', 'textarea', array('label' => 'Descripción'))
            ->add('aceptar', 'submit', array('label'=>'Confirmar evolución'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Neurologia\BDBundle\Entity\Evolucion'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'neurologia_evolucionbundle_evolucion';
    }
}
