<?php

namespace Neurologia\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('NeurologiaMainBundle:Default:home.html.twig');
    }
}
