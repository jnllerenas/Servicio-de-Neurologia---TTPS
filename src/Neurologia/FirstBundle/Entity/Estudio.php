<?php

namespace Neurologia\FirstBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Estudio
 *
 * @ORM\Table(name="estudio", indexes={@ORM\Index(name="id_evolucion", columns={"id_evolucion"}), @ORM\Index(name="id_tipo_estudio", columns={"id_tipo_estudio"})})
 * @ORM\Entity
 */
class Estudio
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_estudio", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEstudio;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="institucion", type="string", length=255, nullable=true)
     */
    private $institucion;

    /**
     * @var \TipoEstudio
     *
     * @ORM\ManyToOne(targetEntity="Neurologia\GenericosBundle\Entity\TipoEstudio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_estudio", referencedColumnName="id_tipo_estudio")
     * })
     */
    private $idTipoEstudio;

    /**
     * @var \Evolucion
     *
     * @ORM\ManyToOne(targetEntity="Evolucion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_evolucion", referencedColumnName="id_evolucion")
     * })
     */
    private $idEvolucion;



    /**
     * Get idEstudio
     *
     * @return integer 
     */
    public function getIdEstudio()
    {
        return $this->idEstudio;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Estudio
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
     * Set institucion
     *
     * @param string $institucion
     * @return Estudio
     */
    public function setInstitucion($institucion)
    {
        $this->institucion = $institucion;

        return $this;
    }

    /**
     * Get institucion
     *
     * @return string 
     */
    public function getInstitucion()
    {
        return $this->institucion;
    }

    /**
     * Set idTipoEstudio
     *
     * @param \Neurologia\FirstBundle\Entity\TipoEstudio $idTipoEstudio
     * @return Estudio
     */
    public function setIdTipoEstudio(\Neurologia\FirstBundle\Entity\TipoEstudio $idTipoEstudio = null)
    {
        $this->idTipoEstudio = $idTipoEstudio;

        return $this;
    }

    /**
     * Get idTipoEstudio
     *
     * @return \Neurologia\FirstBundle\Entity\TipoEstudio 
     */
    public function getIdTipoEstudio()
    {
        return $this->idTipoEstudio;
    }

    /**
     * Set idEvolucion
     *
     * @param \Neurologia\FirstBundle\Entity\Evolucion $idEvolucion
     * @return Estudio
     */
    public function setIdEvolucion(\Neurologia\FirstBundle\Entity\Evolucion $idEvolucion = null)
    {
        $this->idEvolucion = $idEvolucion;

        return $this;
    }

    /**
     * Get idEvolucion
     *
     * @return \Neurologia\FirstBundle\Entity\Evolucion 
     */
    public function getIdEvolucion()
    {
        return $this->idEvolucion;
    }
}
