<?php

namespace Neurologia\FirstBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evolucion
 *
 * @ORM\Table(name="evolucion", indexes={@ORM\Index(name="id_historia_clinica", columns={"id_historia_clinica"}), @ORM\Index(name="id_usuario", columns={"id_usuario"})})
 * @ORM\Entity
 */
class Evolucion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_evolucion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEvolucion;

    /**
     * @var string
     *
     * @ORM\Column(name="evolucion", type="string", length=255, nullable=true)
     */
    private $evolucion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_consulta", type="datetime", nullable=true)
     */
    private $fechaHoraConsulta;

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
     * @var \HistoriaClinica
     *
     * @ORM\ManyToOne(targetEntity="HistoriaClinica")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_historia_clinica", referencedColumnName="id_paciente")
     * })
     */
    private $idHistoriaClinica;



    /**
     * Get idEvolucion
     *
     * @return integer 
     */
    public function getIdEvolucion()
    {
        return $this->idEvolucion;
    }

    /**
     * Set evolucion
     *
     * @param string $evolucion
     * @return Evolucion
     */
    public function setEvolucion($evolucion)
    {
        $this->evolucion = $evolucion;

        return $this;
    }

    /**
     * Get evolucion
     *
     * @return string 
     */
    public function getEvolucion()
    {
        return $this->evolucion;
    }

    /**
     * Set fechaHoraConsulta
     *
     * @param \DateTime $fechaHoraConsulta
     * @return Evolucion
     */
    public function setFechaHoraConsulta($fechaHoraConsulta)
    {
        $this->fechaHoraConsulta = $fechaHoraConsulta;

        return $this;
    }

    /**
     * Get fechaHoraConsulta
     *
     * @return \DateTime 
     */
    public function getFechaHoraConsulta()
    {
        return $this->fechaHoraConsulta;
    }

    /**
     * Set idUsuario
     *
     * @param \Neurologia\FirstBundle\Entity\Usuario $idUsuario
     * @return Evolucion
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

    /**
     * Set idHistoriaClinica
     *
     * @param \Neurologia\FirstBundle\Entity\HistoriaClinica $idHistoriaClinica
     * @return Evolucion
     */
    public function setIdHistoriaClinica(\Neurologia\FirstBundle\Entity\HistoriaClinica $idHistoriaClinica = null)
    {
        $this->idHistoriaClinica = $idHistoriaClinica;

        return $this;
    }

    /**
     * Get idHistoriaClinica
     *
     * @return \Neurologia\FirstBundle\Entity\HistoriaClinica 
     */
    public function getIdHistoriaClinica()
    {
        return $this->idHistoriaClinica;
    }
}
