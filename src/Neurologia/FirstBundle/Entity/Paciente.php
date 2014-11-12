<?php

namespace Neurologia\FirstBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Paciente
 *
 * @ORM\Table(name="paciente", indexes={@ORM\Index(name="id_nivel_educacional", columns={"id_nivel_educacional"}), @ORM\Index(name="id_obra_social", columns={"id_obra_social"}), @ORM\Index(name="id_usuario", columns={"id_usuario"}), @ORM\Index(name="id_departamento", columns={"id_departamento"})})
 * @ORM\Entity
 */
class Paciente
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_persona", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPersona;

    /**
     * @var string
     *
     * @ORM\Column(name="ocupacion", type="string", length=255, nullable=true)
     */
    private $ocupacion;

    /**
     * @var string
     *
     * @ORM\Column(name="otros", type="string", length=255, nullable=true)
     */
    private $otros;

    /**
     * @var \Departamento
     *
     * @ORM\ManyToOne(targetEntity="Neurologia\GenericosBundle\Entity\Departamento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_departamento", referencedColumnName="id_departamento")
     * })
     */
    private $idDepartamento;

    /**
     * @var \NivelEducacional
     *
     * @ORM\ManyToOne(targetEntity="Neurologia\GenericosBundle\Entity\NivelEducacional")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_nivel_educacional", referencedColumnName="id_nivel_educacional")
     * })
     */
    private $idNivelEducacional;

    /**
     * @var \ObraSocial
     *
     * @ORM\ManyToOne(targetEntity="Neurologia\GenericosBundle\Entity\ObraSocial")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_obra_social", referencedColumnName="id_obra_social")
     * })
     */
    private $idObraSocial;

    /**
     * @var \Usuario
     *
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario", referencedColumnName="id_persona")
     * })
     */
    private $idUsuario;



    /**
     * Get idPersona
     *
     * @return integer 
     */
    public function getIdPersona()
    {
        return $this->idPersona;
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
     * Set idDepartamento
     *
     * @param \Neurologia\FirstBundle\Entity\Departamento $idDepartamento
     * @return Paciente
     */
    public function setIdDepartamento(\Neurologia\FirstBundle\Entity\Departamento $idDepartamento = null)
    {
        $this->idDepartamento = $idDepartamento;

        return $this;
    }

    /**
     * Get idDepartamento
     *
     * @return \Neurologia\FirstBundle\Entity\Departamento 
     */
    public function getIdDepartamento()
    {
        return $this->idDepartamento;
    }

    /**
     * Set idNivelEducacional
     *
     * @param \Neurologia\FirstBundle\Entity\NivelEducacional $idNivelEducacional
     * @return Paciente
     */
    public function setIdNivelEducacional(\Neurologia\FirstBundle\Entity\NivelEducacional $idNivelEducacional = null)
    {
        $this->idNivelEducacional = $idNivelEducacional;

        return $this;
    }

    /**
     * Get idNivelEducacional
     *
     * @return \Neurologia\FirstBundle\Entity\NivelEducacional 
     */
    public function getIdNivelEducacional()
    {
        return $this->idNivelEducacional;
    }

    /**
     * Set idObraSocial
     *
     * @param \Neurologia\FirstBundle\Entity\ObraSocial $idObraSocial
     * @return Paciente
     */
    public function setIdObraSocial(\Neurologia\FirstBundle\Entity\ObraSocial $idObraSocial = null)
    {
        $this->idObraSocial = $idObraSocial;

        return $this;
    }

    /**
     * Get idObraSocial
     *
     * @return \Neurologia\FirstBundle\Entity\ObraSocial 
     */
    public function getIdObraSocial()
    {
        return $this->idObraSocial;
    }

    /**
     * Set idUsuario
     *
     * @param \Neurologia\FirstBundle\Entity\Usuario $idUsuario
     * @return Paciente
     */
    public function setIdUsuario(\Neurologia\FirstBundle\Entity\Usuario $idUsuario = null)
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }

    /**
     * Get idUsuario
     *
     * @return \Neurologia\FirstBundle\Entity\Usuario 
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }
}
