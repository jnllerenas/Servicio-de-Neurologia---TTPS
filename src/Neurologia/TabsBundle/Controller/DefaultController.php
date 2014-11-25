<?php

namespace Neurologia\TabsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('NeurologiaTabsBundle:Default:index.html.twig', array());
    }
	
	public function tabAction($nroTab)
    {
        return $this->render('NeurologiaTabsBundle:Default:index'.$nroTab.'.html.twig', array('nro'=>$nroTab));
    }
}
