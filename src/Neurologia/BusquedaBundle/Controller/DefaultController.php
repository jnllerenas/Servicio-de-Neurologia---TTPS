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

    public function pacienteAction()
    {

        $form = $this->createForm(new PacienteType());
        $request = $this->getRequest();
        $vars["titulobusqueda"]="de pacientes";
        $vars["lista"]=false;
        $vars["valoreselegidos"]=false;
        $name=$request->get($form->getName());
        $method=$request->getMethod();
        $elegidosstring='';
        if($method=='GET' && $name){
            $formDatos=$name;
            $nombre=$formDatos['nombre'];
            $apellido=$formDatos['apellido'];
            $documento=$formDatos['documento'];
            $telefono=$formDatos['telefono'];
            $fechaNacimiento=$formDatos['fechaNacimiento'];
            
            $parametros=array();
            $where=array();
            $wherestring='';
            $elegidosstring='';
            
            $em = $this->getDoctrine()->getManager();
            
            if($nombre!=''){
              $where[]='p.nombre = :nombre';
              $parametros['nombre'] = $nombre;
              $elegido[]='nombre: '.$nombre;
            }
            if($apellido!=''){
              $where[]='p.apellido = :apellido';
              $parametros['apellido'] = $apellido;
              $elegido[]='apellido: '.$apellido;
            }
            if($documento!=''){
              $where[]='p.documento = :documento';
              $parametros['documento'] = $documento;
              $elegido[]='documento: '.$documento;
            }
            if($telefono!=''){
              $where[]='p.telefono = :telefono';
              $parametros['telefono'] = $telefono;
              $elegido[]='teléfono: '.$telefono;
            }
            if($fechaNacimiento!=''){
              $where[]='p.fechaNacimiento = :fechaNacimiento';
              $parametros['fechaNacimiento'] = $fechaNacimiento;
              $elegido[]='fecha de nacimiento: '.$fechaNacimiento;
            }
            if($where){
              $wherestring="WHERE ".implode(' AND ', $where). ' ';
              $elegidosstring='con '.implode(', ', $elegido);
            }
            $queryString="SELECT p.id, p.nombre, p.apellido, p.documento, p.fechaNacimiento, p.telefono "
                    . "FROM NeurologiaBDBundle:Paciente p "
                    . "$wherestring";
            $query= $em->createQuery($queryString);
            if($parametros){
                $query->setParameters($parametros);
            }
            $vars["lista"]=$query->getResult();
            $vars["valoreselegidos"]=$elegidosstring;
        }
        $vars["form"]=$form->createView();
        return $this->render('NeurologiaBusquedaBundle:Default:paciente.html.twig', $vars);
    }
    public function usuarioAction(Request $request)
    {
        $form = $this->createForm(new UsuarioType());
        $request = $this->getRequest();
        $vars["titulobusqueda"]="de usuarios";
        $vars["lista"]=false;
        $vars["valoreselegidos"]=false;
        $name=$request->get($form->getName());
        $method=$request->getMethod();
        $elegidosstring='';
        $wherestring='';
        $parametros=array();
        if($method=='GET' && $name){
            $formDatos=$name;
            $nombre=$formDatos['nombre'];
            $apellido=$formDatos['apellido'];
            $documento=$formDatos['documento'];
            $usuario=$formDatos['usuario'];
            $activo=$formDatos['activo'];
                     
            
            
            $where=array();
            
            
            if($nombre!=''){
              $where[]='u.nombre = :nombre';
              $parametros['nombre'] = $nombre;
              $elegido[]='nombre: '.$nombre;
            }
            if($apellido!=''){
              $where[]='u.apellido = :apellido';
              $parametros['apellido'] = $apellido;
              $elegido[]='apellido: '.$apellido;
            }
            if($documento!=''){
              $where[]='u.numero_documento = :documento';
              $parametros['documento'] = $documento;
              $elegido[]='documento: '.$documento;
            }
            if($usuario!=''){
              $where[]='u.usuario = :usuario';
              $parametros['usuario'] = $usuario;
              $elegido[]='usuario: '.$usuario;
            }
            if($activo!=''){
              $where[]='u.enabled = :activo';
              $parametros['activo'] = $activo;
              if($activo){
                  $elegido[]='estado: activo';
              }else{
                  $elegido[]='estado: inactivo';
              }
            }
            if($where){
              $wherestring="WHERE ".implode(' AND ', $where). ' ';
              $elegidosstring='con '.implode(', ', $elegido);
            }
            
        }
        $queryString="SELECT u.id, u.nombre, u.apellido, u.numero_documento as documento, u.username, u.enabled "
                    . "FROM NeurologiaBDBundle:User u "
                    . "$wherestring";
        
        $em = $this->getDoctrine()->getManager();
        $query= $em->createQuery($queryString);
        if($parametros){
            $query->setParameters($parametros);
        }
        $vars["lista"]=$query->getResult();
        $vars["valoreselegidos"]=$elegidosstring;
        $vars["form"]=$form->createView();
        return $this->render('NeurologiaBusquedaBundle:Default:usuario.html.twig', $vars);
        
    }
    public function avanzadaAction()
    {
        $form = $this->createForm(new AvanzadaType());
        $request = $this->getRequest();
        $vars["titulobusqueda"]="avanzada de pacientes";
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
              $where[]='EXISTS (SELECT dd1 '
                      . 'FROM NeurologiaBDBundle:DiagnosticoDefinitivo dd1 '
                      . 'INNER JOIN NeurologiaBDBundle:Evolucion e1 WITH dd1.evolucion = e1 '
                      . 'WHERE dd1.categoriaDiagnostico = :categoriaDiagnostico '
                      . 'AND e1.historiaClinica = h)';
              $parametros['categoriaDiagnostico'] = $categoriaDiagnostico;
              $elegido[]='categoría de diagnóstico: '.$em->getRepository("NeurologiaBDBundle:CategoriaDiagnostico")->find($categoriaDiagnostico)->getDescripcion();
          }
          if($droga!=''){
            $where[]='EXISTS (SELECT dt1 FROM NeurologiaBDBundle:DrogaTratamiento dt1 '
                    . 'INNER JOIN NeurologiaBDBundle:TratamientoInterno ti1 WITH dt1.tratamiento = ti1 '
                    . 'INNER JOIN NeurologiaBDBundle:Evolucion e2 WITH ti1.evolucion = e2 '
                    . 'WHERE dt1.droga = :droga '
                    . 'AND e2.historiaClinica = h)';
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
            $where[]='EXISTS (SELECT dt2 '
                    . 'FROM NeurologiaBDBundle:DrogaTratamiento dt2 '
                    . 'INNER JOIN NeurologiaBDBundle:TratamientoInterno ti2 WITH dt2.tratamiento = ti2 '
                    . 'INNER JOIN NeurologiaBDBundle:Evolucion e2 WITH ti2.evolucion = e2 '
                    . 'WHERE dt2.efectoAdverso = :efectoAdverso '
                    . 'AND e2.historiaClinica = h) ';
            $parametros['efectoAdverso'] = $efectoAdverso;
            $elegido[]='efecto adverso en tratamiento: '.$em->getRepository("NeurologiaBDBundle:EfectoAdverso")->find($efectoAdverso)->getDescripcion();
          }
          if($where){
              $wherestring="WHERE ".implode(' AND ', $where). ' ';
              $elegidosstring='con '.implode(', ', $elegido);
          }
          
          $querypacientes="SELECT DISTINCT p.id FROM NeurologiaBDBundle:HistoriaClinica h 
                            INNER JOIN NeurologiaBDBundle:Paciente p WITH h.paciente = p
                  $wherestring"
                  . "GROUP BY p.id";
          $queryenfermedad="SELECT MAX(eac.id) as id FROM NeurologiaBDBundle:EnfermedadActual eac"
                  . " INNER JOIN NeurologiaBDBundle:HistoriaClinica hicl WITH eac.historiaClinica=hicl"
                  . " GROUP BY hicl ";
          $queryString="SELECT pa.nombre, pa.apellido, pa.fechaNacimiento, s.descripcion as sexo, ea.detalle as enfermedad
                  FROM NeurologiaBDBundle:Paciente pa 
              INNER JOIN NeurologiaBDBundle:HistoriaClinica hc WITH hc.paciente = pa
              INNER JOIN NeurologiaBDBundle:Sexo s WITH pa.sexo = s
              INNER JOIN NeurologiaBDBundle:EnfermedadActual ea WITH ea.historiaClinica = hc
                  WHERE pa.id IN ($querypacientes)"
                  . " AND ea.id IN($queryenfermedad)";
          
          $query= $em->createQuery($queryString);
          if($parametros){
              $query->setParameters($parametros);
          }
          $vars["lista"]=$query->getResult();
          $vars["valoreselegidos"]=$elegidosstring;
        }
        $vars['form']=$form->createView();

        return $this->render('NeurologiaBusquedaBundle:Default:avanzada.html.twig', $vars);
    }
}
