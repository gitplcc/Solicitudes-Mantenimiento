<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Solicitud
 *
 * @ORM\Table(name="solicitud")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SolicitudRepository")
 */
class Solicitud
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
     * @ORM\Column(name="Solicitante", type="string", length=255)
     */
    private $solicitante;

    /**
     * @var string
     *
     * @ORM\Column(name="Destino", type="string", length=255)
     */
    private $destino;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Fecha", type="datetime")
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="Extension", type="string", length=255)
     */
    private $extension;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="estancia", type="string", length=255)
     */
    private $estancia;

    /**
     * @var string
     *
     * @ORM\Column(name="DescripcionIncidencia", type="text")
     */
    private $descripcionIncidencia;

    /**
     * @var bool
     *
     * @ORM\Column(name="Pendiente", type="boolean")
     */
    private $pendiente;

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
     * Set solicitante
     *
     * @param string $solicitante
     *
     * @return Solicitud
     */
    public function setSolicitante($solicitante)
    {
        $this->solicitante = $solicitante;

        return $this;
    }

    /**
     * Get solicitante
     *
     * @return string
     */
    public function getSolicitante()
    {
        return $this->solicitante;
    }

    /**
     * Set destino
     *
     * @param string $destino
     *
     * @return Solicitud
     */
    public function setDestino($destino)
    {
        $this->destino = $destino;

        return $this;
    }

    /**
     * Get destino
     *
     * @return string
     */
    public function getDestino()
    {
        return $this->destino;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Solicitud
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
     * Set extension
     *
     * @param string $extension
     *
     * @return Solicitud
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;

        return $this;
    }

    /**
     * Get extension
     *
     * @return string
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Solicitud
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set estancia
     *
     * @param string $estancia
     *
     * @return Solicitud
     */
    public function setEstancia($estancia)
    {
        $this->estancia = $estancia;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEstancia()
    {
        return $this->estancia;
    }

    /**
     * Set descripcionIncidencia
     *
     * @param string $descripcionIncidencia
     *
     * @return Solicitud
     */
    public function setDescripcionIncidencia($descripcionIncidencia)
    {
        $this->descripcionIncidencia = $descripcionIncidencia;

        return $this;
    }

    /**
     * Get descripcionIncidencia
     *
     * @return string
     */
    public function getDescripcionIncidencia()
    {
        return $this->descripcionIncidencia;
    }

    /**
     * Set pendiente
     *
     * @param boolean $pendiente
     *
     * @return Solicitud
     */
    public function setPendiente($pendiente)
    {
        $this->pendiente = $pendiente;

        return $this;
    }

    /**
     * Get pendiente
     *
     * @return boolean
     */
    public function getPendiente()
    {
        return $this->pendiente;
    }
}
