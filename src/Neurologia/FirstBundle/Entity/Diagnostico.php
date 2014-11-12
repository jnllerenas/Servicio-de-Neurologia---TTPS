<?php

namespace Neurologia\FirstBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Diagnostico
 *
 * @ORM\Table(name="diagnostico", indexes={@ORM\Index(name="id_evolucion", columns={"id_evolucion"})})
 * @ORM\Entity
 */
class Diagnostico
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_diagnostico", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDiagnostico;

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
     * Get idDiagnostico
     *
     * @return integer 
     */
    public function getIdDiagnostico()
    {
        return $this->idDiagnostico;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Diagnostico
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
     * @return Diagnostico
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
