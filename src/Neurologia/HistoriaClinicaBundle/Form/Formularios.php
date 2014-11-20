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
    
    public static function createIniciarForm($a, $idpaciente) {
         return $a->createFormBuilder()
        ->setAction($a->generateUrl('neurologia_historia_clinica_iniciar', array('idpaciente' => $idpaciente)))
        ->add('Iniciar Historia Clinica', 'submit', array('label' => 'Iniciar Historia Clinica'))
        ->getForm();
        
    }
    
    public static function createHistoriaForm($a,array $list,$idpaciente) {
        return $a->createFormBuilder()
        ->setAction($a->generateUrl('neurologia_historia_clinica_iniciar', array('idpaciente' => $idpaciente)))
        
        ->add('derivado', 'choice', array(
                                 'choice_list' => new SimpleChoiceList($list),
                                  'label' => '*Derivado por: '  
            ))
        ->add('motivo', 'text',array('required' => true,'label' => '*Motivo: '))
        ->add('enfermedad', 'textarea',array('required' => true,'label' => '*Enfermedad Actual: '))
        ->add('enviar', 'submit', array('label' => 'Enviar'))
        ->getForm();
    }
    
     public static function createMotivoForm($a, $id) {
         return $a->createFormBuilder()
        ->setAction($a->generateUrl('neurologia_historia_clinica_motivo_nuevo', array('id' => $id)))
        ->add('nuevo', 'submit', array('label' => 'Nuevo'))
        ->getForm();
        
    }
    
     public static function nuevoMotivoForm($a,$id) {
        return $a->createFormBuilder()
        ->setAction($a->generateUrl('neurologia_historia_clinica_motivo_nuevo', array('id' => $id)))
        ->add('detalle', 'textarea',array('required' => true,'label' => 'Detalle del Motivo: '))
        ->add('enviar', 'submit', array('label' => 'Enviar'))
        ->getForm();
    }
    
      public static function createEnfermedadForm($a, $id) {
         return $a->createFormBuilder()
        ->setAction($a->generateUrl('neurologia_historia_clinica_enfermedad_nuevo', array('id' => $id)))
        ->add('nuevo', 'submit', array('label' => 'Nuevo'))
        ->getForm();
        
    }
    
     public static function nuevaEnfermedadForm($a,$id) {
        return $a->createFormBuilder()
        ->setAction($a->generateUrl('neurologia_historia_clinica_enfermedad_nuevo', array('id' => $id)))
        ->add('detalle', 'textarea',array('required' => true,'label' => 'Detalle de la Enfermedad: '))
        ->add('enviar', 'submit', array('label' => 'Enviar'))
        ->getForm();
    }
}
