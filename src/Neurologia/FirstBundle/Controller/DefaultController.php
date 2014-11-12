<?php

namespace Neurologia\FirstBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class DefaultController extends Controller
{
    public function indexAction()
    {	
		return $this->render('NeurologiaFirstBundle:Default:index.html.twig');
		
    }
	
	public function backendAction($name)
    {
        return $this->render('NeurologiaFirstBundle:Default:backend.html.twig', compact('name'));
    }
	
	public function loginAction(Request $request)
    {
		if ($request->getMethod()=='POST'){
			$username = $request->get('username');
			$password = $request->get('password');
			$em = $this->getDoctrine()->getManager();
			$repositorio = $em->getRepository('NeurologiaFirstBundle:Usuario');
			
			$usuario = $repositorio->findOneBy(array('username'=>$username,'password'=>$password));
		//var_dump($usuario);
					
			 $rol = $usuario->getIdRol()->getDescripcion();
			 $datos = $usuario->getIdPersona()->getApellido().' , '.$usuario->getIdPersona()->getNombre();
		//var_dump($rol);
			
			if($usuario){
				//cargar la sesion con valores necesarios
				$session = new Session();
				$session->start();
				$session->set('idRol', $usuario->getIdRol());
				$session->set('idUsuario', $usuario->getIdPersona());
		//var_dump($session->get('idRol'));
		
				return $this->render('NeurologiaFirstBundle:Default:index.html.twig', array(
																						'username'=>$usuario->getUsername(),
																						'datos'=>$datos,
																						'rol'=>$rol));
			}
			else{
				return $this->render('NeurologiaFirstBundle:Default:login.html.twig', array('error'=>"Login Error"));
			}
		}
		return $this->render('NeurologiaFirstBundle:Default:login.html.twig');
    }
	
	 public function logoutAction(Request $request) {
        $session = $this->getRequest()->getSession();
        $session->clear();
        return $this->render('NeurologiaFirstBundle:Default:login.html.twig');
    }
}
