<?php

namespace Neurologia\FirstBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Definitivo
 *
 * @ORM\Table(name="definitivo", indexes={@ORM\Index(name="id_categoria_diagnostico", columns={"id_categoria_diagnostico"})})
 * @ORM\Entity
 */
class Definitivo
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
     * @var \CategoriaDiagnostico
     *
     * @ORM\ManyToOne(targetEntity="Neurologia\GenericosBundle\Entity\CategoriaDiagnostico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_categoria_diagnostico", referencedColumnName="id_categoria_diagnostico")
     * })
     */
    private $idCategoriaDiagnostico;



    /**
     * Set idDiagnostico
     *
     * @param \Neurologia\FirstBundle\Entity\Diagnostico $idDiagnostico
     * @return Definitivo
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

    /**
     * Set idCategoriaDiagnostico
     *
     * @param \Neurologia\FirstBundle\Entity\CategoriaDiagnostico $idCategoriaDiagnostico
     * @return Definitivo
     */
    public function setIdCategoriaDiagnostico(\Neurologia\FirstBundle\Entity\CategoriaDiagnostico $idCategoriaDiagnostico = null)
    {
        $this->idCategoriaDiagnostico = $idCategoriaDiagnostico;

        return $this;
    }

    /**
     * Get idCategoriaDiagnostico
     *
     * @return \Neurologia\FirstBundle\Entity\CategoriaDiagnostico 
     */
    public function getIdCategoriaDiagnostico()
    {
        return $this->idCategoriaDiagnostico;
    }
}