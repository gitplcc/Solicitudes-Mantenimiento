<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Parte
 *
 * @ORM\Table(name="parte")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ParteRepository")
 */
class Parte
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="localizacion", type="string", length=255)
     */
    private $localizacion;

    /**
     * @var string
     *
     * @ORM\Column(name="trabajador", type="string", length=255)
     */
    private $trabajador;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechainicio", type="datetime")
     */
    private $fechainicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechafin", type="datetime")
     */
    private $fechafin;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text")
     */
    private $descripcion;

    /**
     * @ORM\OneToOne(targetEntity="Solicitud")
     * @ORM\JoinColumn(name="solicitud_id", referencedColumnName="id")
     */
     private $solicitud;

     /**
      * @var int
      *
      * @ORM\Column(name="satisfaccion", type="integer",  nullable=true)
      */
     private $satisfaccion;

     /**
      * @var string
      *
      * @ORM\Column(name="observaciones", type="text",  nullable=true)
      */
     private $observaciones;

     /**
      * @var int
      *
      * @ORM\Column(name="completado", type="integer",  nullable=true)
      */
     private $completado;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set localizacion
     *
     * @param string $localizacion
     *
     * @return Parte
     */
    public function setLocalizacion($localizacion)
    {
        $this->localizacion = $localizacion;

        return $this;
    }

    /**
     * Get localizacion
     *
     * @return string
     */
    public function getLocalizacion()
    {
        return $this->localizacion;
    }

    /**
     * Set trabajador
     *
     * @param string $trabajador
     *
     * @return Parte
     */
    public function setTrabajador($trabajador)
    {
        $this->trabajador = $trabajador;

        return $this;
    }

    /**
     * Get trabajador
     *
     * @return string
     */
    public function getTrabajador()
    {
        return $this->trabajador;
    }

    /**
     * Set fechainicio
     *
     * @param \DateTime $fechainicio
     *
     * @return Parte
     */
    public function setFechainicio($fechainicio)
    {
        $this->fechainicio = $fechainicio;

        return $this;
    }

    /**
     * Get fechainicio
     *
     * @return \DateTime
     */
    public function getFechainicio()
    {
        return $this->fechainicio;
    }

    /**
     * Set fechafin
     *
     * @param \DateTime $fechafin
     *
     * @return Parte
     */
    public function setFechafin($fechafin)
    {
        $this->fechafin = $fechafin;

        return $this;
    }

    /**
     * Get fechafin
     *
     * @return \DateTime
     */
    public function getFechafin()
    {
        return $this->fechafin;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Parte
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
   * Set solicitud
   *
   * @param \AppBundle\Entity\Solicitud $solicitud
   *
   * @return Parte
   */
  public function setSolicitud(\AppBundle\Entity\Solicitud $solicitud = null)
  {
      $this->solicitud = $solicitud;

      return $this;
  }

  /**
   * Get solicitud
   *
   * @return \AppBundle\Entity\Solicitud
   */
  public function getSolicitud()
  {
      return $this->solicitud;
    }

    /**
     * Get satisfaccion
     *
     * @return int
     */
    public function getSatisfaccion()
    {
        return $this->satisfaccion;
    }

    /**
     * Set satisfaccion
     *
     * @param integer $satisfaccion
     *
     * @return Parte
     */
    public function setSatisfaccion($satisfaccion)
    {
        $this->satisfaccion = $satisfaccion;

        return $this;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return Parte
     */
    public function setobservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Get completado
     *
     * @return int
     */
    public function getCompletado()
    {
        return $this->completado;
    }

    /**
     * Set completado
     *
     * @param integer $completado
     *
     * @return Parte
     */
    public function setCompletado($completado)
    {
        $this->completado = $completado;

        return $this;
    }
}
