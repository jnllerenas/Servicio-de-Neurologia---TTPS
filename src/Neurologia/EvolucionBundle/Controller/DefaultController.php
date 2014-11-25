<?php

namespace Neurologia\EvolucionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('EvolucionBundle:Default:index.html.twig', array('name' => $name));
    }
}
