<?php

namespace Neurologia\FirstBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Motivo
 *
 * @ORM\Table(name="motivo", indexes={@ORM\Index(name="id_historia_clinica", columns={"id_historia_clinica"})})
 * @ORM\Entity
 */
class Motivo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_motivo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMotivo;

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
     * Get idMotivo
     *
     * @return integer 
     */
    public function getIdMotivo()
    {
        return $this->idMotivo;
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
     * Set idHistoriaClinica
     *
     * @param \Neurologia\FirstBundle\Entity\HistoriaClinica $idHistoriaClinica
     * @return Motivo
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
