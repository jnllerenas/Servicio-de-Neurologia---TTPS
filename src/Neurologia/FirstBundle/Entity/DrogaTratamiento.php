<?php

namespace Neurologia\FirstBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DrogaTratamiento
 *
 * @ORM\Table(name="droga_tratamiento", indexes={@ORM\Index(name="id_droga", columns={"id_droga"}), @ORM\Index(name="id_efecto_adverso", columns={"id_efecto_adverso"}), @ORM\Index(name="IDX_F9CB63A71E8DD6F2", columns={"id_interno"})})
 * @ORM\Entity
 */
class DrogaTratamiento
{
    /**
     * @var string
     *
     * @ORM\Column(name="dosis", type="string", length=255, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $dosis;

    /**
     * @var \EfectoAdverso
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Neurologia\GenericosBundle\Entity\EfectoAdverso")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_efecto_adverso", referencedColumnName="id_efecto_adverso")
     * })
     */
    private $idEfectoAdverso;

    /**
     * @var \Droga
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Neurologia\GenericosBundle\Entity\Droga")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_droga", referencedColumnName="id_droga")
     * })
     */
    private $idDroga;

    /**
     * @var \Interno
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Interno")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_interno", referencedColumnName="id_tratamiento")
     * })
     */
    private $idInterno;



    /**
     * Set dosis
     *
     * @param string $dosis
     * @return DrogaTratamiento
     */
    public function setDosis($dosis)
    {
        $this->dosis = $dosis;

        return $this;
    }

    /**
     * Get dosis
     *
     * @return string 
     */
    public function getDosis()
    {
        return $this->dosis;
    }

    /**
     * Set idEfectoAdverso
     *
     * @param \Neurologia\FirstBundle\Entity\EfectoAdverso $idEfectoAdverso
     * @return DrogaTratamiento
     */
    public function setIdEfectoAdverso(\Neurologia\FirstBundle\Entity\EfectoAdverso $idEfectoAdverso)
    {
        $this->idEfectoAdverso = $idEfectoAdverso;

        return $this;
    }

    /**
     * Get idEfectoAdverso
     *
     * @return \Neurologia\FirstBundle\Entity\EfectoAdverso 
     */
    public function getIdEfectoAdverso()
    {
        return $this->idEfectoAdverso;
    }

    /**
     * Set idDroga
     *
     * @param \Neurologia\FirstBundle\Entity\Droga $idDroga
     * @return DrogaTratamiento
     */
    public function setIdDroga(\Neurologia\FirstBundle\Entity\Droga $idDroga)
    {
        $this->idDroga = $idDroga;

        return $this;
    }

    /**
     * Get idDroga
     *
     * @return \Neurologia\FirstBundle\Entity\Droga 
     */
    public function getIdDroga()
    {
        return $this->idDroga;
    }

    /**
     * Set idInterno
     *
     * @param \Neurologia\FirstBundle\Entity\Interno $idInterno
     * @return DrogaTratamiento
     */
    public function setIdInterno(\Neurologia\FirstBundle\Entity\Interno $idInterno)
    {
        $this->idInterno = $idInterno;

        return $this;
    }

    /**
     * Get idInterno
     *
     * @return \Neurologia\FirstBundle\Entity\Interno 
     */
    public function getIdInterno()
    {
        return $this->idInterno;
    }
}
