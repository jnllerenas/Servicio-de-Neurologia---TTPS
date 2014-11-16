<?php

namespace Neurologia\BDBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Motivo
 *
 * @ORM\Table(name="motivo", indexes={@ORM\Index(name="FK_motivo", columns={"historia_clinica_id"})})
 * @ORM\Entity
 */
class Motivo
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
     * @return Motivo
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
     * Set historiaClinica
     *
     * @param \Neurologia\BDBundle\Entity\HistoriaClinica $historiaClinica
     * @return Motivo
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
