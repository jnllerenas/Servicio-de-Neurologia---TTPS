<?php

namespace Neurologia\FirstBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Externo
 *
 * @ORM\Table(name="externo")
 * @ORM\Entity
 */
class Externo
{
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
     * Set idTratamiento
     *
     * @param \Neurologia\FirstBundle\Entity\Tratamiento $idTratamiento
     * @return Externo
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
