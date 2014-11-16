<?php

namespace Neurologia\AntecedenteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('NeurologiaAntecedenteBundle:Default:index.html.twig', array('name' => $name));
    }
}
