<?php

namespace Neurologia\GenericosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function abmAction()
    {
        return $this->render('NeurologiaGenericosBundle:Default:abm.html.twig');
    }
}
