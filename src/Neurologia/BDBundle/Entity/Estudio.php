<?php

namespace Neurologia\BDBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Estudio
 *
 * @ORM\Table(name="estudio")
 * @ORM\Entity
 */
class Estudio
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
    * @Assert\Valid()
    * @ORM\OneToMany(targetEntity="Imagen", cascade={"persist"}, mappedBy="estudio")
    */
    
    protected $imagenes;
    
        public function __construct()
    {
        $this->imagenes = new ArrayCollection();
    }

        public function getImagenes()
    {
        return $this->imagenes;
    }
    
        public function addImagen(Imagen $imagen)
    {
        $imagen->addEstudio($this);
        $this->imagenes->add($imagen);
    }
    
    public function removeImagen(Imagen $imagen)
    {
        $this->imagenes->removeElement($imagen);
    }

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="institucion", type="string", length=255, nullable=true)
     */
    private $institucion;

    /**
     * @var \Evolucion
     *
     * @ORM\ManyToOne(targetEntity="Neurologia\BDBundle\Entity\Evolucion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="evolucion_id", referencedColumnName="id")
     * })
     */
    private $evolucion;

    /**
     * @var \TipoEstudio
     *
     * @ORM\ManyToOne(targetEntity="Neurologia\BDBundle\Entity\TipoEstudio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipo_estudio_id", referencedColumnName="id")
     * })
     */
    private $tipoEstudio;



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
     * Set evolucion
     *
     * @param \Neurologia\BDBundle\Entity\Evolucion $evolucion
     * @return Estudio
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

    /**
     * Set tipoEstudio
     *
     * @param \Neurologia\BDBundle\Entity\TipoEstudio $tipoEstudio
     * @return Estudio
     */
    public function setTipoEstudio(\Neurologia\BDBundle\Entity\TipoEstudio $tipoEstudio = null)
    {
        $this->tipoEstudio = $tipoEstudio;

        return $this;
    }

    /**
     * Get tipoEstudio
     *
     * @return \Neurologia\BDBundle\Entity\TipoEstudio 
     */
    public function getTipoEstudio()
    {
        return $this->tipoEstudio;
    }
}
