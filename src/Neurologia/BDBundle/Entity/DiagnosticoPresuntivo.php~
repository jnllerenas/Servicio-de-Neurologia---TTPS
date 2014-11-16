<?php

namespace Neurologia\BDBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DiagnosticoPresuntivo
 *
 * @ORM\Table(name="diagnostico_presuntivo", indexes={@ORM\Index(name="FK_diagnostico_presuntivo", columns={"evolucion_id"})})
 * @ORM\Entity
 */
class DiagnosticoPresuntivo
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
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=false)
     */
    private $descripcion;

	/**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=false)
     */
    private $fecha;
	
    /**
     * @var \Evolucion
     *
     * @ORM\ManyToOne(targetEntity="Evolucion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="evolucion_id", referencedColumnName="id")
     * })
     */
    private $evolucion;



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
     * Set descripcion
     *
     * @param string $descripcion
     * @return DiagnosticoPresuntivo
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }
	    
	/**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Estudio
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
     * Set evolucion
     *
     * @param \Neurologia\BDBundle\Entity\Evolucion $evolucion
     * @return DiagnosticoPresuntivo
     */
    public function setEvolucion(\Neurologia\BDBundle\Entity\Evolucion $evolucion = null)
    {
        $this->evolucion = $evolucion;

        return $this;
    }

    /**
     * Get evolucion
     *
     * @return \Neurologia\BDBundle\Entity\Evolucion 
     */
    public function getEvolucion()
    {
        return $this->evolucion;
    }
}
