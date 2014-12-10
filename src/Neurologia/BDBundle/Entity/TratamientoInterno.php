<?php

namespace Neurologia\BDBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Neurologia\BDBundle\Entity\DrogaTratamiento;
use Doctrine\ORM\Mapping as ORM;

/**
 * TratamientoInterno
 *
 * @ORM\Table(name="tratamiento_interno", indexes={@ORM\Index(name="FK_tratamiento_interno", columns={"evolucion_id"})})
 * @ORM\Entity
 */
class TratamientoInterno
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
     * @ORM\Column(name="inicio", type="date", nullable=false)
     */
    private $inicio;

    /**
     * @var boolean
     *
     * @ORM\Column(name="activo", type="boolean", nullable=true)
     */
    private $activo;

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
     * Bidirectional - One-To-Many (INVERSE SIDE)
     *
     * @ORM\OneToMany(targetEntity="DrogaTratamiento", mappedBy="tratamiento", cascade={"persist", "remove"})
     */
    protected $drogaTratamiento;
    
        public function __construct()
    {
        $this->drogaTratamiento = new ArrayCollection();
    }

        public function getDrogaTratamiento()
    {
        return $this->drogaTratamiento;
    }
    
        public function addDrogaTratamiento(DrogaTratamiento $droga)
        {
        $this->drogaTratamiento->add($droga);
        $droga->addTratamiento($this);
    }
        public function agregarTratamientoADrogas()
    {
        foreach ($this->getDrogaTratamiento() as $value) {
            $value->addTratamiento($this);
        }
    } 
    public function removeDrogaTratamiento(DrogaTratamiento $droga)
    {
        $this->drogaTratamiento->removeElement($droga);
    }

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
     * @return TratamientoInterno
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
     * Set inicio
     *
     * @param \DateTime $inicio
     * @return TratamientoInterno
     */
    public function setInicio($inicio)
    {
        $this->inicio = $inicio;

        return $this;
    }

    /**
     * Get inicio
     *
     * @return \DateTime 
     */
    public function getInicio()
    {
        return $this->inicio;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     * @return TratamientoInterno
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get activo
     *
     * @return boolean 
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * Set evolucion
     *
     * @param \Neurologia\BDBundle\Entity\Evolucion $evolucion
     * @return TratamientoInterno
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
