<?php

namespace Neurologia\BDBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EnfermedadActual
 *
 * @ORM\Table(name="enfermedad_actual", indexes={@ORM\Index(name="FK_enfermedad_actual", columns={"historia_clinica_id"}), @ORM\Index(name="FK_enfermedad_actual2", columns={"usuario_id"})})
 * @ORM\Entity
 */
class EnfermedadActual
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
     * @ORM\Column(name="detalle", type="string", length=255, nullable=false)
     */
    private $detalle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=false)
     */
    private $fecha;

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
     * Set detalle
     *
     * @param string $detalle
     * @return EnfermedadActual
     */
    public function setDetalle($detalle)
    {
        $this->detalle = $detalle;

        return $this;
    }

    /**
     * Get detalle
     *
     * @return string 
     */
    public function getDetalle()
    {
        return $this->detalle;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return EnfermedadActual
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set usuario
     *
     * @param \Neurologia\BDBundle\Entity\User $usuario
     * @return EnfermedadActual
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
     * @return EnfermedadActual
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
