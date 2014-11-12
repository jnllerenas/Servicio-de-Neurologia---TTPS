<?php

namespace Neurologia\FirstBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tratamiento
 *
 * @ORM\Table(name="tratamiento", indexes={@ORM\Index(name="id_evolucion", columns={"id_evolucion"})})
 * @ORM\Entity
 */
class Tratamiento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_tratamiento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTratamiento;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=true)
     */
    private $descripcion;

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
     * Get idTratamiento
     *
     * @return integer 
     */
    public function getIdTratamiento()
    {
        return $this->idTratamiento;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Tratamiento
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
     * Set idEvolucion
     *
     * @param \Neurologia\FirstBundle\Entity\Evolucion $idEvolucion
     * @return Tratamiento
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
