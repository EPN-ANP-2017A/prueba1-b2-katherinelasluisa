<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Clientes
 *
 * @ORM\Table(name="clientes")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ClientesRepository")
 */
class Clientes
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
     * @ORM\Column(name="nombre", type="string", length=80)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="cedula", type="string", length=10, unique=true)
     */
    private $cedula;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechanacim", type="date")
     */
    private $fechanacim;


    /**
     * @ORM\OneToMany(targetEntity="Pedidos", mappedBy="cliente")
     */
    private $pedidos;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pedidos = new ArrayCollection();
    }


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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Clientes
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set cedula
     *
     * @param string $cedula
     *
     * @return Clientes
     */
    public function setCedula($cedula)
    {
        $this->cedula = $cedula;

        return $this;
    }

    /**
     * Get cedula
     *
     * @return string
     */
    public function getCedula()
    {
        return $this->cedula;
    }

    /**
     * Set fechanacim
     *
     * @param \DateTime $fechanacim
     *
     * @return Clientes
     */
    public function setFechanacim($fechanacim)
    {
        $this->fechanacim = $fechanacim;

        return $this;
    }

    /**
     * Get fechanacim
     *
     * @return \DateTime
     */
    public function getFechanacim()
    {
        return $this->fechanacim;
    }

    /**
     * Add pedido
     *
     * @param \AppBundle\Entity\Pedidos $pedido
     *
     * @return Clientes
     */
    public function addPedido(\AppBundle\Entity\Pedidos $pedido)
    {
        $this->pedidos[] = $pedido;

        return $this;
    }

    /**
     * Remove pedido
     *
     * @param \AppBundle\Entity\Pedidos $pedido
     */
    public function removePedido(\AppBundle\Entity\Pedidos $pedido)
    {
        $this->pedidos->removeElement($pedido);
    }

    /**
     * Get pedidos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPedidos()
    {
        return $this->pedidos;
    }
}
