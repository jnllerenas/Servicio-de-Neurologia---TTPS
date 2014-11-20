<?php
// src/Neurologia/UserBundle/Entity/User.php

namespace Neurologia\BDBundle\Entity;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message="Please enter your name.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=3,
     *     max="255",
     *     minMessage="The name is too short.",
     *     maxMessage="The name is too long.",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $nombre;
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $apellido;
    /**
     * @ORM\Column(type="string", length=15)
     */
    protected $numero_documento;
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $telefono; 
    /**
     * @ORM\Column(type="datetime", length=100)
     */
    protected $fecha_de_nacimiento;
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $direccion;
    
        /**
     * @var \TipoDocumento
     *
     * @ORM\ManyToOne(targetEntity="Neurologia\GenericosBundle\Entity\TipoDocumento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipo_documento_id", referencedColumnName="id")
     * })
     */
    private $tipoDocumento;
    
    /**
     * @var \EstadoCivil
     *
     * @ORM\ManyToOne(targetEntity="Neurologia\GenericosBundle\Entity\EstadoCivil")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="estado_civil_id", referencedColumnName="id")
     * })
     */
    private $estadoCivil;

    /**
     * @var \Sexo
     *
     * @ORM\ManyToOne(targetEntity="Neurologia\GenericosBundle\Entity\Sexo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sexo_id", referencedColumnName="id")
     * })
     */
    private $sexo;
    
    
    public function __construct()
    {
        parent::__construct();
        // your own logic

    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Usuario
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
     * @return Usuario
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
     * Set numero_documento
     *
     * @param string $numeroDocumento
     * @return Usuario
     */
    public function setNumeroDocumento($numeroDocumento)
    {
        $this->numero_documento = $numeroDocumento;

        return $this;
    }

    /**
     * Get numero_documento
     *
     * @return string 
     */
    public function getNumeroDocumento()
    {
        return $this->numero_documento;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     * @return Usuario
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
     * Set fecha_de_nacimiento
     *
     * @param string $fechaDeNacimiento
     * @return Usuario
     */
    public function setFechaDeNacimiento($fechaDeNacimiento)
    {
        $this->fecha_de_nacimiento = $fechaDeNacimiento;

        return $this;
    }

    /**
     * Get fecha_de_nacimiento
     *
     * @return string 
     */
    public function getFechaDeNacimiento()
    {
        return $this->fecha_de_nacimiento;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return Usuario
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set tipoDocumento
     *
     * @param \Neurologia\GenericosBundle\Entity\TipoDocumento $tipoDocumento
     * @return User
     */
    public function setTipoDocumento(\Neurologia\GenericosBundle\Entity\TipoDocumento $tipoDocumento = null)
    {
        $this->tipoDocumento = $tipoDocumento;

        return $this;
    }

    /**
     * Get tipoDocumento
     *
     * @return \Neurologia\GenericosBundle\Entity\TipoDocumento 
     */
    public function getTipoDocumento()
    {
        return $this->tipoDocumento;
    }

    /**
     * Set estadoCivil
     *
     * @param \Neurologia\GenericosBundle\Entity\EstadoCivil $estadoCivil
     * @return User
     */
    public function setEstadoCivil(\Neurologia\GenericosBundle\Entity\EstadoCivil $estadoCivil = null)
    {
        $this->estadoCivil = $estadoCivil;

        return $this;
    }

    /**
     * Get estadoCivil
     *
     * @return \Neurologia\GenericosBundle\Entity\EstadoCivil 
     */
    public function getEstadoCivil()
    {
        return $this->estadoCivil;
    }

    /**
     * Set sexo
     *
     * @param \Neurologia\GenericosBundle\Entity\Sexo $sexo
     * @return User
     */
    public function setSexo(\Neurologia\GenericosBundle\Entity\Sexo $sexo = null)
    {
        $this->sexo = $sexo;

        return $this;
    }

    /**
     * Get sexo
     *
     * @return \Neurologia\GenericosBundle\Entity\Sexo 
     */
    public function getSexo()
    {
        return $this->sexo;
    }
}
