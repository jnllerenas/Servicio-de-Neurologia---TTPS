<?php

namespace Neurologia\FirstBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Interno
 *
 * @ORM\Table(name="interno")
 * @ORM\Entity
 */
class Interno
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="inicio", type="date", nullable=true)
     */
    private $inicio;

    /**
     * @var boolean
     *
     * @ORM\Column(name="activo", type="boolean", nullable=true)
     */
    private $activo;

    /**
     * @var \Tratamiento
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Tratamiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tratamiento", referencedColumnName="id_tratamiento")
     * })
     */
    private $idTratamiento;



    /**
     * Set inicio
     *
     * @param \DateTime $inicio
     * @return Interno
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
     * @return Interno
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
     * Set idTratamiento
     *
     * @param \Neurologia\FirstBundle\Entity\Tratamiento $idTratamiento
     * @return Interno
     */
    public function setIdTratamiento(\Neurologia\FirstBundle\Entity\Tratamiento $idTratamiento)
    {
        $this->idTratamiento = $idTratamiento;

        return $this;
    }

    /**
     * Get idTratamiento
     *
     * @return \Neurologia\FirstBundle\Entity\Tratamiento 
     */
    public function getIdTratamiento()
    {
        return $this->idTratamiento;
    }
}
