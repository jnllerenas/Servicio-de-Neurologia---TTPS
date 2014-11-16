<?php

namespace Neurologia\BDBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evolucion
 *
 * @ORM\Table(name="evolucion", indexes={@ORM\Index(name="FK_evolucion", columns={"historia_clinica_id"}), @ORM\Index(name="FK_evolucion2", columns={"usuario_id"})})
 * @ORM\Entity
 */
class Evolucion
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
     * @ORM\Column(name="evolucion", type="string", length=255, nullable=false)
     */
    private $evolucion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora", type="datetime", nullable=false)
     */
    private $fechaHora;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     * })
     */
    private $usuario;

    /**
     * @var \HistoriaClinica
     *
     * @ORM\ManyToOne(targetEntity="HistoriaClinica")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="historia_clinica_id", referencedColumnName="id")
     * })
     */
    private $historiaClinica;



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
     * Set fechaHora
     *
     * @param \DateTime $fechaHora
     * @return Evolucion
     */
    public function setFechaHora($fechaHora)
    {
        $this->fechaHora = $fechaHora;

        return $this;
    }

    /**
     * Get fechaHora
     *
     * @return \DateTime 
     */
    public function getFechaHora()
    {
        return $this->fechaHora;
    }

    /**
     * Set usuario
     *
     * @param \Neurologia\BDBundle\Entity\User $usuario
     * @return Evolucion
     */
    public function setUsuario(\Neurologia\BDBundle\Entity\User $usuario = null)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return \Neurologia\BDBundle\Entity\User 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set historiaClinica
     *
     * @param \Neurologia\BDBundle\Entity\HistoriaClinica $historiaClinica
     * @return Evolucion
     */
    public function setHistoriaClinica(\Neurologia\BDBundle\Entity\HistoriaClinica $historiaClinica = null)
    {
        $this->historiaClinica = $historiaClinica;

        return $this;
    }

    /**
     * Get historiaClinica
     *
     * @return \Neurologia\BDBundle\Entity\HistoriaClinica 
     */
    public function getHistoriaClinica()
    {
        return $this->historiaClinica;
    }
}
