<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pedidos
 *
 * @ORM\Table(name="pedidos")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PedidosRepository")
 */
class Pedidos
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
     * @var int
     *
     * @ORM\Column(name="cantidad", type="integer")
     */
    private $cantidad;


    /**
     * @ORM\ManyToOne(targetEntity="Clientes", inversedBy="pedidos")
     * @ORM\JoinColumn(name="cliente_id", referencedColumnName="id")
     */
    private $cliente;

    /**
     * @ORM\ManyToOne(targetEntity="Platos", inversedBy="pedido")
     * @ORM\JoinColumn(name="plato_id", referencedColumnName="id")
     */
    private $plato;


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
     * Set cantidad
     *
     * @param integer $cantidad
     *
     * @return Pedidos
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad
     *
     * @return int
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set cliente
     *
     * @param \AppBundle\Entity\Clientes $cliente
     *
     * @return Pedidos
     */
    public function setCliente(\AppBundle\Entity\Clientes $cliente = null)
    {
        $this->cliente = $cliente;

        return $this;
    }

    /**
     * Get cliente
     *
     * @return \AppBundle\Entity\Clientes
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * Set plato
     *
     * @param \AppBundle\Entity\Platos $plato
     *
     * @return Pedidos
     */
    public function setPlato(\AppBundle\Entity\Platos $plato = null)
    {
        $this->plato = $plato;

        return $this;
    }

    /**
     * Get plato
     *
     * @return \AppBundle\Entity\Platos
     */
    public function getPlato()
    {
        return $this->plato;
    }
}
