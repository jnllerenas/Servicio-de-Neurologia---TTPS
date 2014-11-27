<?php

namespace Neurologia\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $_SESSION['user'] = $this->container->get('security.context')->getToken()->getUser();
        
        return $this->render('NeurologiaMainBundle:Default:home.html.twig');
    }
}
