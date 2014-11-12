<?php

namespace Neurologia\FirstBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Presuntivo
 *
 * @ORM\Table(name="presuntivo")
 * @ORM\Entity
 */
class Presuntivo
{
    /**
     * @var \Diagnostico
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Diagnostico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_diagnostico", referencedColumnName="id_diagnostico")
     * })
     */
    private $idDiagnostico;



    /**
     * Set idDiagnostico
     *
     * @param \Neurologia\FirstBundle\Entity\Diagnostico $idDiagnostico
     * @return Presuntivo
     */
    public function setIdDiagnostico(\Neurologia\FirstBundle\Entity\Diagnostico $idDiagnostico)
    {
        $this->idDiagnostico = $idDiagnostico;

        return $this;
    }

    /**
     * Get idDiagnostico
     *
     * @return \Neurologia\FirstBundle\Entity\Diagnostico 
     */
    public function getIdDiagnostico()
    {
        return $this->idDiagnostico;
    }
}
