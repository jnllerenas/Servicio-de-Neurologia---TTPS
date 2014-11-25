<?php

namespace Neurologia\BDBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Antecedente
 *
 * @ORM\Table(name="antecedente", indexes={@ORM\Index(name="FK_antecedente", columns={"tipo_antecedente_id"}), @ORM\Index(name="FK_antecedente2", columns={"historia_clinica_id"}), @ORM\Index(name="FK_antecedente3", columns={"usuario_id"})})
 * @ORM\Entity
 */
class Antecedente
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
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=false)
     */
    private $descripcion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     * })
     */
    private $usuario;

    /**
     * @var \TipoAntecedente
     *
     * @ORM\ManyToOne(targetEntity="TipoAntecedente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipo_antecedente_id", referencedColumnName="id")
     * })
     */
    private $tipoAntecedente;

    /**
     * @var \HistoriaClinica
     *
     * @ORM\ManyToOne(targetEntity="HistoriaClinica")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="historia_clinica_id", referencedColumnName="id")
     * })
     */
    private $historiaClinica;



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
     * @return Antecedente
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
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Antecedente
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set usuario
     *
     * @param \Neurologia\BDBundle\Entity\User $usuario
     * @return Antecedente
     */
    public function setUsuario(\Neurologia\BDBundle\Entity\User $usuario = null)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return \Neurologia\BDBundle\Entity\User 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set tipoAntecedente
     *
     * @param \Neurologia\BDBundle\Entity\TipoAntecedente $tipoAntecedente
     * @return Antecedente
     */
    public function setTipoAntecedente(\Neurologia\BDBundle\Entity\TipoAntecedente $tipoAntecedente = null)
    {
        $this->tipoAntecedente = $tipoAntecedente;

        return $this;
    }

    /**
     * Get tipoAntecedente
     *
     * @return \Neurologia\BDBundle\Entity\TipoAntecedente 
     */
    public function getTipoAntecedente()
    {
        return $this->tipoAntecedente;
    }

    /**
     * Set historiaClinica
     *
     * @param \Neurologia\BDBundle\Entity\HistoriaClinica $historiaClinica
     * @return Antecedente
     */
    public function setHistoriaClinica(\Neurologia\BDBundle\Entity\HistoriaClinica $historiaClinica = null)
    {
        $this->historiaClinica = $historiaClinica;

        return $this;
    }

    /**
     * Get historiaClinica
     *
     * @return \Neurologia\BDBundle\Entity\HistoriaClinica 
     */
    public function getHistoriaClinica()
    {
        return $this->historiaClinica;
    }
}
