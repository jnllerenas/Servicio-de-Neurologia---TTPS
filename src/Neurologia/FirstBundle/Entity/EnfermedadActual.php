<?php

namespace Neurologia\FirstBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EnfermedadActual
 *
 * @ORM\Table(name="enfermedad_actual", indexes={@ORM\Index(name="id_historia_clinica", columns={"id_historia_clinica"})})
 * @ORM\Entity
 */
class EnfermedadActual
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_enfermedad_actual", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEnfermedadActual;

    /**
     * @var string
     *
     * @ORM\Column(name="detalle", type="string", length=255, nullable=true)
     */
    private $detalle;

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
     * Get idEnfermedadActual
     *
     * @return integer 
     */
    public function getIdEnfermedadActual()
    {
        return $this->idEnfermedadActual;
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
     * Set idHistoriaClinica
     *
     * @param \Neurologia\FirstBundle\Entity\HistoriaClinica $idHistoriaClinica
     * @return EnfermedadActual
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
