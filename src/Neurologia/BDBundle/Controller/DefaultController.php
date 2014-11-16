<?php

namespace Neurologia\BDBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('NeurologiaBDBundle:Default:index.html.twig', array('name' => $name));
    }
}
