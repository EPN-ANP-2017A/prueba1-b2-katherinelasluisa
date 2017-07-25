<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Platos
 *
 * @ORM\Table(name="platos")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PlatosRepository")
 */
class Platos
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
     * @ORM\Column(name="precio", type="decimal", precision=10, scale=0)
     */
    private $precio;

    /**
     * @var bool
     *
     * @ORM\Column(name="disponible", type="boolean")
     */
    private $disponible;


    /**
     * @ORM\OneToMany(targetEntity="Pedidos", mappedBy="plato")
     */
    private $pedidos;


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
     * @return Platos
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
     * Set precio
     *
     * @param string $precio
     *
     * @return Platos
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get precio
     *
     * @return string
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set disponible
     *
     * @param boolean $disponible
     *
     * @return Platos
     */
    public function setDisponible($disponible)
    {
        $this->disponible = $disponible;

        return $this;
    }

    /**
     * Get disponible
     *
     * @return bool
     */
    public function getDisponible()
    {
        return $this->disponible;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pedidos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add pedido
     *
     * @param \AppBundle\Entity\Pedidos $pedido
     *
     * @return Platos
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
