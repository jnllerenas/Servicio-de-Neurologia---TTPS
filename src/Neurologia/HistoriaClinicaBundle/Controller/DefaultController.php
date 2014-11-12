<?php

namespace Neurologia\HistoriaClinicaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        //si llegamos acá supuestamente tenemos seleccionado un paciente
        return $this->render('NeurologiaHistoriaClinicaBundle:Default:index.html.twig', array());
    }
}
