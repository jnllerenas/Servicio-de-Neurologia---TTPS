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
        
        
        
        $builder->add('droga', 'entity', array(
            'empty_value' => 'Elija una droga',
            'required' => true,
            'class' => 'NeurologiaBDBundle:Droga',
            'property' => 'descripcion',
           
        ))
          ->add('efectoAdverso', 'entity', array(
            'empty_value' => 'Elija una efecto adverso',
            'required' => true,
            'class' => 'NeurologiaBDBundle:EfectoAdverso',
            'property' => 'descripcion',
              ))
          ->add('dosis', 'text',array('max_length'=>'15'))  
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
