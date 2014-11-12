<?php

namespace Neurologia\FirstBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HistoriaClinica
 *
 * @ORM\Table(name="historia_clinica")
 * @ORM\Entity
 */
class HistoriaClinica
{
    /**
     * @var \Paciente
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Paciente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_paciente", referencedColumnName="id_persona")
     * })
     */
    private $idPaciente;



    /**
     * Set idPaciente
     *
     * @param \Neurologia\FirstBundle\Entity\Paciente $idPaciente
     * @return HistoriaClinica
     */
    public function setIdPaciente(\Neurologia\FirstBundle\Entity\Paciente $idPaciente)
    {
        $this->idPaciente = $idPaciente;

        return $this;
    }

    /**
     * Get idPaciente
     *
     * @return \Neurologia\FirstBundle\Entity\Paciente 
     */
    public function getIdPaciente()
    {
        return $this->idPaciente;
    }
}
