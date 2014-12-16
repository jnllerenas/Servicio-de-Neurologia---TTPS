<?php

namespace Neurologia\BDBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('NeurologiaBDBundle:Default:index.html.twig');
    }
    public function backupAction(Request $request)
    {
        $method=$request->getMethod();
        $mensaje="No se pudo realizar la copia de seguridad de la base de datos";
        $database_user=$this->container->getParameter('database_user');
        $database_password=$this->container->getParameter('database_password');
        $database_name=$this->container->getParameter('database_name');
        $folder='c:\\backups\\';
        $nombre="neurologia_".date('d-m-Y_H-i-s').".sql";
        if(!is_dir($folder)){
            mkdir($folder);
        }
        $path='C:\wamp\bin\mysql\mysql5.6.12\bin';
//		$path = getenv("PATHMYSL");
//		if ($path==false){
//			$mensaje="Cree la variable de entorno PATHMYSQL como variable de entorno escribiendo en la consola -> set PATHMYSQ='elpath'";
//			return $this->render('NeurologiaBDBundle:Default:backup.html.twig',array('mensaje'=>$mensaje));
//		}
        $comando='"'.$path.'\\mysqldump.exe" -u '.$database_user;
        if($database_password !== null){
            $comando.=" -p$database_password";
        }
        $comando.=" $database_name > ".$folder.$nombre;
        //$mensaje=$comando;
        if(system($comando)!==false){
            $mensaje="Se ha realizado la copia de seguridad en $folder con el nombre: $nombre.";
        }
        return $this->render('NeurologiaBDBundle:Default:backup.html.twig',array('mensaje'=>$mensaje));
    }
}