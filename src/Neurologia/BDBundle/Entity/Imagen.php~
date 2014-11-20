<?php

namespace Neurologia\BDBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Imagen
 *
 * @ORM\Table(name="imagen", indexes={@ORM\Index(name="FK_imagen", columns={"estudio_id"})})
 * @ORM\Entity
 */
class Imagen
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
     * @ORM\Column(name="archivo", type="string", length=255, nullable=false)
     */
    private $archivo;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @var \Estudio
     *
     * @ORM\ManyToOne(targetEntity="Estudio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="estudio_id", referencedColumnName="id")
     * })
     */
    private $estudio;



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
     * Set archivo
     *
     * @param string $archivo
     * @return Imagen
     */
    public function setArchivo($archivo)
    {
        $this->archivo = $archivo;

        return $this;
    }

    /**
     * Get archivo
     *
     * @return string 
     */
    public function getArchivo()
    {
        return $this->archivo;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Imagen
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
     * Set estudio
     *
     * @param \Neurologia\BDBundle\Entity\Estudio $estudio
     * @return Imagen
     */
    public function setEstudio(\Neurologia\BDBundle\Entity\Estudio $estudio = null)
    {
        $this->estudio = $estudio;

        return $this;
    }

    /**
     * Get estudio
     *
     * @return \Neurologia\BDBundle\Entity\Estudio 
     */
    public function getEstudio()
    {
        return $this->estudio;
    }
}
