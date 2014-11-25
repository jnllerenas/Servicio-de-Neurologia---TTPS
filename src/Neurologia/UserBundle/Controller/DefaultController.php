<?php

namespace Neurologia\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

     public function adminAction() {
        return $this->render('NeurologiaUserBundle:Default:admin.html.twig');
    }

    public function userAction() {
        return $this->render('NeurologiaUserBundle:Default:user.html.twig');
    }

    public function agregarUsuarioAction() {
        return $this->render('NeurologiaUserBundle:Default:agregarUsuario.html.twig');
    }


}
