<?php

namespace Neurologia\TratamientoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TratamientoController extends Controller
{
    
    public function indexAction()
    {
        return $this->render('TratamientoBundle:Tratamiento:tratamiento.html.twig');
    }
    
}
