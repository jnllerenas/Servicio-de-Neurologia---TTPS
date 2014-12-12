<?php

namespace Neurologia\BDBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Paciente
 *
 * @ORM\Table(name="paciente", indexes={@ORM\Index(name="FK_paciente", columns={"obra_social_id"}), @ORM\Index(name="FK_paciente2", columns={"estado_civil_id"}), @ORM\Index(name="FK_paciente3", columns={"tipo_documento_id"}), @ORM\Index(name="FK_paciente4", columns={"admitido_por"}), @ORM\Index(name="FK_paciente5", columns={"derivado_por"}), @ORM\Index(name="FK_paciente6", columns={"sexo_id"}), @ORM\Index(name="FK_paciente7", columns={"nivel_educacional_id"})})
 * @ORM\Entity
 */
class Paciente
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=30, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido", type="string", length=30, nullable=false)
     */
    private $apellido;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=30, nullable=true)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="documento", type="string", length=30, nullable=false)
     */
    private $documento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_nacimiento", type="date", nullable=false)
     */
    private $fechaNacimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=30, nullable=false)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="ocupacion", type="string", length=30, nullable=true)
     */
    private $ocupacion;

    /**
     * @var string
     *
     * @ORM\Column(name="otros", type="string", length=255, nullable=true)
     */
    private $otros;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_carnet", type="string", length=30, nullable=false)
     */
    private $numeroCarnet;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=30, nullable=true)
     */
    private $email;

    /**
     * @var \NivelEducacional
     *
     * @ORM\ManyToOne(targetEntity="\Neurologia\BDBundle\Entity\NivelEducacional")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="nivel_educacional_id", referencedColumnName="id")
     * })
     */
    private $nivelEducacional;

    /**
     * @var \ObraSocial
     *
     * @ORM\ManyToOne(targetEntity="\Neurologia\BDBundle\Entity\ObraSocial")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="obra_social_id", referencedColumnName="id")
     * })
     */
    private $obraSocial;

    /**
     * @var \EstadoCivil
     *
     * @ORM\ManyToOne(targetEntity="\Neurologia\BDBundle\Entity\EstadoCivil")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="estado_civil_id", referencedColumnName="id")
     * })
     */
    private $estadoCivil;

    /**
     * @var \TipoDocumento
     *
     * @ORM\ManyToOne(targetEntity="\Neurologia\BDBundle\Entity\TipoDocumento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipo_documento_id", referencedColumnName="id")
     * })
     */
    private $tipoDocumento;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="Neurologia\BDBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="admitido_por", referencedColumnName="id")
     * })
     */
    private $admitidoPor;

    /**
     * @var \Departamento
     *
     * @ORM\ManyToOne(targetEntity="\Neurologia\BDBundle\Entity\Departamento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="derivado_por", referencedColumnName="id")
     * })
     */
    private $derivadoPor;

    /**
     * @var \Sexo
     *
     * @ORM\ManyToOne(targetEntity="\Neurologia\BDBundle\Entity\Sexo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sexo_id", referencedColumnName="id")
     * })
     */
    private $sexo;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Paciente
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set apellido
     *
     * @param string $apellido
     * @return Paciente
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido
     *
     * @return string 
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return Paciente
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set documento
     *
     * @param string $documento
     * @return Paciente
     */
    public function setDocumento($documento)
    {
        $this->documento = $documento;

        return $this;
    }

    /**
     * Get documento
     *
     * @return string 
     */
    public function getDocumento()
    {
        return $this->documento;
    }

    /**
     * Set fechaNacimiento
     *
     * @param \DateTime $fechaNacimiento
     * @return Paciente
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    /**
     * Get fechaNacimiento
     *
     * @return \DateTime 
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     * @return Paciente
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string 
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set ocupacion
     *
     * @param string $ocupacion
     * @return Paciente
     */
    public function setOcupacion($ocupacion)
    {
        $this->ocupacion = $ocupacion;

        return $this;
    }

    /**
     * Get ocupacion
     *
     * @return string 
     */
    public function getOcupacion()
    {
        return $this->ocupacion;
    }

    /**
     * Set otros
     *
     * @param string $otros
     * @return Paciente
     */
    public function setOtros($otros)
    {
        $this->otros = $otros;

        return $this;
    }

    /**
     * Get otros
     *
     * @return string 
     */
    public function getOtros()
    {
        return $this->otros;
    }

    /**
     * Set numeroCarnet
     *
     * @param string $numeroCarnet
     * @return Paciente
     */
    public function setNumeroCarnet($numeroCarnet)
    {
        $this->numeroCarnet = $numeroCarnet;

        return $this;
    }

    /**
     * Get numeroCarnet
     *
     * @return string 
     */
    public function getNumeroCarnet()
    {
        return $this->numeroCarnet;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Paciente
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set nivelEducacional
     *
     * @param \Neurologia\BDBundle\Entity\NivelEducacional $nivelEducacional
     * @return Paciente
     */
    public function setNivelEducacional(\Neurologia\BDBundle\Entity\NivelEducacional $nivelEducacional = null)
    {
        $this->nivelEducacional = $nivelEducacional;

        return $this;
    }

    /**
     * Get nivelEducacional
     *
     * @return \Neurologia\BDBundle\Entity\NivelEducacional 
     */
    public function getNivelEducacional()
    {
        return $this->nivelEducacional;
    }

    /**
     * Set obraSocial
     *
     * @param \Neurologia\BDBundle\Entity\ObraSocial $obraSocial
     * @return Paciente
     */
    public function setObraSocial(\Neurologia\BDBundle\Entity\ObraSocial $obraSocial = null)
    {
        $this->obraSocial = $obraSocial;

        return $this;
    }

    /**
     * Get obraSocial
     *
     * @return \Neurologia\BDBundle\Entity\ObraSocial 
     */
    public function getObraSocial()
    {
        return $this->obraSocial;
    }

    /**
     * Set estadoCivil
     *
     * @param \Neurologia\BDBundle\Entity\EstadoCivil $estadoCivil
     * @return Paciente
     */
    public function setEstadoCivil(\Neurologia\BDBundle\Entity\EstadoCivil $estadoCivil = null)
    {
        $this->estadoCivil = $estadoCivil;

        return $this;
    }

    /**
     * Get estadoCivil
     *
     * @return \Neurologia\BDBundle\Entity\EstadoCivil 
     */
    public function getEstadoCivil()
    {
        return $this->estadoCivil;
    }

    /**
     * Set tipoDocumento
     *
     * @param \Neurologia\BDBundle\Entity\TipoDocumento $tipoDocumento
     * @return Paciente
     */
    public function setTipoDocumento(\Neurologia\BDBundle\Entity\TipoDocumento $tipoDocumento = null)
    {
        $this->tipoDocumento = $tipoDocumento;

        return $this;
    }

    /**
     * Get tipoDocumento
     *
     * @return \Neurologia\BDBundle\Entity\TipoDocumento 
     */
    public function getTipoDocumento()
    {
        return $this->tipoDocumento;
    }

    /**
     * Set admitidoPor
     *
     * @param \Neurologia\BDBundle\Entity\User $admitidoPor
     * @return Paciente
     */
    public function setAdmitidoPor(\Neurologia\BDBundle\Entity\User $admitidoPor = null)
    {
        $this->admitidoPor = $admitidoPor;

        return $this;
    }

    /**
     * Get admitidoPor
     *
     * @return \Neurologia\BDBundle\Entity\User 
     */
    public function getAdmitidoPor()
    {
        return $this->admitidoPor;
    }

    /**
     * Set derivadoPor
     *
     * @param \Neurologia\BDBundle\Entity\Departamento $derivadoPor
     * @return Paciente
     */
    public function setDerivadoPor(\Neurologia\BDBundle\Entity\Departamento $derivadoPor = null)
    {
        $this->derivadoPor = $derivadoPor;

        return $this;
    }

    /**
     * Get derivadoPor
     *
     * @return \Neurologia\BDBundle\Entity\Departamento 
     */
    public function getDerivadoPor()
    {
        return $this->derivadoPor;
    }

    /**
     * Set sexo
     *
     * @param \Neurologia\BDBundle\Entity\Sexo $sexo
     * @return Paciente
     */
    public function setSexo(\Neurologia\BDBundle\Entity\Sexo $sexo = null)
    {
        $this->sexo = $sexo;

        return $this;
    }

    /**
     * Get sexo
     *
     * @return \Neurologia\BDBundle\Entity\Sexo 
     */
    public function getSexo()
    {
        return $this->sexo;
    }
}
