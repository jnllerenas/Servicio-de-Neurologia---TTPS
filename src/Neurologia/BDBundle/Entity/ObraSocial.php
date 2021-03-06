<?php

namespace Neurologia\BDBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ObraSocial
 *
 * @ORM\Table(name="obra_social", uniqueConstraints={@ORM\UniqueConstraint(name="descripcion", columns={"descripcion"})})
 * @ORM\Entity
 */
class ObraSocial
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
     * @ORM\Column(name="descripcion", type="string", length=30, nullable=false)
     */
    private $descripcion;



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
     * @return ObraSocial
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
    
            public function __toString()
{
    return $this->descripcion;
}

}
