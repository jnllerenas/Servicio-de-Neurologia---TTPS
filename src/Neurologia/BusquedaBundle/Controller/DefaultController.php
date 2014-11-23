<?php

namespace Neurologia\BusquedaBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Neurologia\BDBundle\Entity\Paciente;
use Neurologia\BDBundle\Entity\Usuario;
use Neurologia\BusquedaBundle\Form\PacienteType;
use Neurologia\BusquedaBundle\Form\UsuarioType;
use Neurologia\BusquedaBundle\Form\AvanzadaType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $vars["lista"]=false;
            $vars["valoreselegidos"]=false;
        return $this->render('NeurologiaBusquedaBundle:Default:index.html.twig', $vars);
    }

    public function pacienteAction(Request $request)
    {

        	$form = $this->createForm(new PacienteType());

        	$form->handleRequest($request);
            $vars["lista"]=false;
            $vars["valoreselegidos"]=false;
            $vars["form"]=$form->createView();

        	if ($form->isValid()) {
        		$em = $this->getDoctrine()->getManager();        
        		

       			return $this->redirect($this->generateUrl('neurologia_busqueda_paciente'));
    		}

        	return $this->render('NeurologiaBusquedaBundle:Default:paciente.html.twig', $vars);
    }
    public function usuarioAction(Request $request)
    {

    }
    public function avanzadaAction()
    {
        $form = $this->createForm(new AvanzadaType());
        $request = $this->getRequest();
        $vars["valoreselegidos"]=false;
        $vars["lista"]=false;
        $name=$request->get($form->getName());
        $method=$request->getMethod();
          $elegidosstring='';
        if($method=='GET' && $name){
          $formDatos=$name;
          $categoriaDiagnostico=$formDatos['categoriaDiagnostico'];
          $droga=$formDatos['droga'];
          $sexo=$formDatos['sexo'];
          $edad=$formDatos['edad'];
          $fechaquery= date('Y-m-d',strtotime(date('Y-m-d').' -'.$edad.' year') ) ;
          $efectoAdverso=$formDatos['efectoAdverso'];
          //echo $categoriaDiagnostico.' '.$droga.' '.$sexo.' '.$edad.' '.$efectoAdverso;
          $parametros=array();
          $where=array();
          $wherestring='';
          $elegidosstring='';
          $em = $this->getDoctrine()->getManager();
          if($categoriaDiagnostico!=''){
              $where[]='dd.categoriaDiagnostico=:categoriaDiagnostico';
              $parametros['categoriaDiagnostico'] = $categoriaDiagnostico;
              $elegido[]='categoría de diagnóstico: '.$em->getRepository("NeurologiaBDBundle:CategoriaDiagnostico")->find($categoriaDiagnostico)->getDescripcion();
          }
          if($droga!=''){
            $where[]='dt.droga = :droga';
            $parametros['droga'] = $droga;
            $elegido[]='droga en tratamiento: '.$em->getRepository("NeurologiaBDBundle:Droga")->find($droga)->getDescripcion();
          }
          if($sexo!=''){
            $where[]='p.sexo = :sexo';
            $parametros['sexo'] = $sexo;
            $elegido[]='sexo: '.$em->getRepository("NeurologiaBDBundle:Sexo")->find($sexo)->getDescripcion();
          }
          if($edad!=''){
            $where[]=":fechaquery BETWEEN p.fechaNacimiento AND DATE_ADD(p.fechaNacimiento,12,'month')";
            $parametros['fechaquery'] = $fechaquery;
            $elegido[]=$edad.' años';
          }
          if($efectoAdverso!=''){
            $where[]='dt.efectoAdverso = :efectoAdverso';
            $parametros['efectoAdverso'] = $efectoAdverso;
            $elegido[]='efecto adverso en tratamiento: '.$em->getRepository("NeurologiaBDBundle:EfectoAdverso")->find($efectoAdverso)->getDescripcion();
          }
          if($where){
              $wherestring="WHERE ".implode(' AND ', $where). ' ';
              $elegidosstring='con '.implode(', ', $elegido);
          }
          
          $querypacientes="SELECT DISTINCT p FROM NeurologiaBDBundle:Paciente p 
              INNER JOIN NeurologiaBDBundle:HistoriaClinica h WITH h.paciente=p
                  LEFT JOIN NeurologiaBDBundle:Evolucion e WITH e.historiaClinica = h
                  LEFT JOIN NeurologiaBDBundle:TratamientoInterno ti WITH ti.evolucion = e
                  LEFT JOIN NeurologiaBDBundle:DrogaTratamiento dt WITH dt.tratamiento = ti
                  LEFT JOIN NeurologiaBDBundle:DiagnosticoDefinitivo dd WITH dd.evolucion = e $wherestring";
          $queryString="SELECT pa.nombre, pa.apellido, pa.fechaNacimiento, s.descripcion as sexo, ea.detalle as enfermedad
                  FROM NeurologiaBDBundle:Paciente pa 
              INNER JOIN NeurologiaBDBundle:HistoriaClinica hc WITH hc.paciente = pa
              INNER JOIN NeurologiaBDBundle:Sexo s WITH pa.sexo = s
              INNER JOIN NeurologiaBDBundle:EnfermedadActual ea WITH ea.historiaClinica = hc
                  WHERE pa IN ($querypacientes)";
          $query= $em->createQuery($queryString);
          if($parametros){
              $query->setParameters($parametros);
          }
          
          $vars["lista"]=$query->getResult();
          $vars["cantidad"]=count($vars["lista"]);
          $vars["valoreselegidos"]=$elegidosstring;
          
          
        }
        $vars['form']=$form->createView();

        return $this->render('NeurologiaBusquedaBundle:Default:avanzada.html.twig', $vars);
    }
}
