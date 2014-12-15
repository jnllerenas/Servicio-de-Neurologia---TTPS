<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of newPHPClass
 *
 * @author Wodan
 */

namespace Neurologia\HistoriaClinicaBundle\Form;
use Symfony\Component\Form\Extension\Core\ChoiceList\SimpleChoiceList;
class Formularios {
    //put your code here
    
    public static function createIniciarForm($a) {
         return $a->createFormBuilder()
        ->setAction($a->generateUrl('neurologia_historia_clinica_iniciar'))
        ->add('Iniciar Historia Clinica', 'submit', array('label' => 'Iniciar Historia Clinica', 'attr'=>array('class'=>"btn btn-primary")))
        ->getForm();
        
    }
    
    public static function createHistoriaForm($a,array $list) {
        return $a->createFormBuilder()
        ->setAction($a->generateUrl('neurologia_historia_clinica_iniciar'))
        
        ->add('derivado', 'choice', array(
                                'required' => true,
                                'choice_list' => new SimpleChoiceList($list),
                                'label' => 'Derivado por: '  
            ))
        ->add('motivo', 'text',array('required' => true,'label' => 'Motivo : ','max_length' => '40'))
        ->add('enfermedad', 'text',array('required' => true,'label' => 'Enfermedad Actual: ','max_length' => '40'))
        ->add('enviar', 'submit', array('label' => 'Crear'))
        ->getForm();
    }
    
     public static function createMotivoForm($a) {
         return $a->createFormBuilder()
        ->setAction($a->generateUrl('motivo_nuevo'))
        ->add('nuevo', 'submit', array('label' => 'Nuevo'))
        ->getForm();
        
    }
    
     public static function nuevoMotivoForm($a) {
        return $a->createFormBuilder()
        ->setAction($a->generateUrl('motivo_nuevo'))
        ->add('detalle', 'text',array('required' => true,'label' => 'Detalle del Motivo: ','max_length' => '40'))
        ->add('enviar', 'submit', array('label' => 'Enviar'))
        ->getForm();
    }
    
      public static function createEnfermedadForm($a) {
         return $a->createFormBuilder()
        ->setAction($a->generateUrl('enfermedad_nuevo'))
        ->add('nuevo', 'submit', array('label' => 'Nuevo'))
        ->getForm();
        
    }
    
     public static function nuevaEnfermedadForm($a) {
        return $a->createFormBuilder()
        ->setAction($a->generateUrl('enfermedad_nuevo'))
        ->add('detalle', 'text',array('required' => true,'label' => 'Detalle de la Enfermedad: ','max_length' => '40'))
        ->add('enviar', 'submit', array('label' => 'Enviar'))
        ->getForm();
    }
}
