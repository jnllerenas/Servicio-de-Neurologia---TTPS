<?php

namespace Neurologia\BDBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DrogaTratamiento
 *
 * @ORM\Table(name="droga_tratamiento", indexes={@ORM\Index(name="FK_droga_tratamiento", columns={"efecto_adverso_id"}), @ORM\Index(name="FK_droga_tratamiento3", columns={"tratamiento_id"}), @ORM\Index(name="IDX_F9CB63A7825E2ABC", columns={"droga_id"})})
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
     * @ORM\OneToOne(targetEntity="EfectoAdverso")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="efecto_adverso_id", referencedColumnName="id")
     * })
     */
    private $efectoAdverso;

    /**
     * @var \Droga
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Droga")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="droga_id", referencedColumnName="id")
     * })
     */
    private $droga;

    /**
     * @var \TratamientoInterno
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="TratamientoInterno")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tratamiento_id", referencedColumnName="id")
     * })
     */
    private $tratamiento;



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
     * Set efectoAdverso
     *
     * @param \Neurologia\BDBundle\Entity\EfectoAdverso $efectoAdverso
     * @return DrogaTratamiento
     */
    public function setEfectoAdverso(\Neurologia\BDBundle\Entity\EfectoAdverso $efectoAdverso)
    {
        $this->efectoAdverso = $efectoAdverso;

        return $this;
    }

    /**
     * Get efectoAdverso
     *
     * @return \Neurologia\BDBundle\Entity\EfectoAdverso 
     */
    public function getEfectoAdverso()
    {
        return $this->efectoAdverso;
    }

    /**
     * Set droga
     *
     * @param \Neurologia\BDBundle\Entity\Droga $droga
     * @return DrogaTratamiento
     */
    public function setDroga(\Neurologia\BDBundle\Entity\Droga $droga)
    {
        $this->droga = $droga;

        return $this;
    }

    /**
     * Get droga
     *
     * @return \Neurologia\BDBundle\Entity\Droga 
     */
    public function getDroga()
    {
        return $this->droga;
    }

    /**
     * Set tratamiento
     *
     * @param \Neurologia\BDBundle\Entity\TratamientoInterno $tratamiento
     * @return DrogaTratamiento
     */
    public function setTratamiento(\Neurologia\BDBundle\Entity\TratamientoInterno $tratamiento)
    {
        $this->tratamiento = $tratamiento;

        return $this;
    }

    /**
     * Get tratamiento
     *
     * @return \Neurologia\BDBundle\Entity\TratamientoInterno 
     */
    public function getTratamiento()
    {
        return $this->tratamiento;
    }
}
