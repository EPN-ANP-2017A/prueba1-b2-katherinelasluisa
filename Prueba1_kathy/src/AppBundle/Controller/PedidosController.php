<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Pedidos;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Pedido controller.
 *
 * @Route("pedidos")
 */
class PedidosController extends Controller
{
    /**
     * Lists all pedido entities.
     *
     * @Route("/", name="pedidos_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pedidos = $em->getRepository('AppBundle:Pedidos')->findAll();

        return $this->render('pedidos/index.html.twig', array(
            'pedidos' => $pedidos,
        ));
    }

    /**
     * Creates a new pedido entity.
     *
     * @Route("/new", name="pedidos_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $pedido = new Pedidos();
        $form = $this->createForm('AppBundle\Form\PedidosType', $pedido);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pedido);
            $em->flush();

            return $this->redirectToRoute('pedidos_show', array('id' => $pedido->getId()));
        }

        return $this->render('pedidos/new.html.twig', array(
            'pedido' => $pedido,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a pedido entity.
     *
     * @Route("/{id}", name="pedidos_show")
     * @Method("GET")
     */
    public function showAction(Pedidos $pedido)
    {
        $deleteForm = $this->createDeleteForm($pedido);

        return $this->render('pedidos/show.html.twig', array(
            'pedido' => $pedido,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing pedido entity.
     *
     * @Route("/{id}/edit", name="pedidos_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Pedidos $pedido)
    {
        $deleteForm = $this->createDeleteForm($pedido);
        $editForm = $this->createForm('AppBundle\Form\PedidosType', $pedido);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pedidos_edit', array('id' => $pedido->getId()));
        }

        return $this->render('pedidos/edit.html.twig', array(
            'pedido' => $pedido,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a pedido entity.
     *
     * @Route("/{id}", name="pedidos_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Pedidos $pedido)
    {
        $form = $this->createDeleteForm($pedido);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($pedido);
            $em->flush();
        }

        return $this->redirectToRoute('pedidos_index');
    }

    /**
     * Creates a form to delete a pedido entity.
     *
     * @param Pedidos $pedido The pedido entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Pedidos $pedido)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pedidos_delete', array('id' => $pedido->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
