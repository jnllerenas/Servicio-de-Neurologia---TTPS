<?php

namespace Neurologia\BDBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', 'text', array('max_length' => '25'))
            ->add('apellido', 'text', array('max_length' => '25'))
            ->add('numero_documento', 'text', array('max_length' => '20'))
            ->add('telefono', 'text', array('max_length' => '20'))
            ->add('fecha_de_nacimiento')
            ->add('direccion', 'text', array('max_length' => '20'))
            ->add('tipoDocumento')
            ->add('estadoCivil')
            ->add('sexo')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Neurologia\BDBundle\Entity\User',
            'csrf_protection' => false,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'neurologia_bdbundle_user';
    }
}
