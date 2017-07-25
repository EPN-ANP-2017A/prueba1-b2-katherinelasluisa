<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Platos;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Plato controller.
 *
 * @Route("platos")
 */
class PlatosController extends Controller
{
    /**
     * Lists all plato entities.
     *
     * @Route("/", name="platos_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $platos = $em->getRepository('AppBundle:Platos')->findAll();

        return $this->render('platos/index.html.twig', array(
            'platos' => $platos,
        ));
    }

    /**
     * Creates a new plato entity.
     *
     * @Route("/new", name="platos_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $plato = new Platos();
        $form = $this->createForm('AppBundle\Form\PlatosType', $plato);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($plato);
            $em->flush();

            return $this->redirectToRoute('platos_show', array('id' => $plato->getId()));
        }

        return $this->render('platos/new.html.twig', array(
            'plato' => $plato,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a plato entity.
     *
     * @Route("/{id}", name="platos_show")
     * @Method("GET")
     */
    public function showAction(Platos $plato)
    {
        $deleteForm = $this->createDeleteForm($plato);

        return $this->render('platos/show.html.twig', array(
            'plato' => $plato,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing plato entity.
     *
     * @Route("/{id}/edit", name="platos_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Platos $plato)
    {
        $deleteForm = $this->createDeleteForm($plato);
        $editForm = $this->createForm('AppBundle\Form\PlatosType', $plato);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('platos_edit', array('id' => $plato->getId()));
        }

        return $this->render('platos/edit.html.twig', array(
            'plato' => $plato,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a plato entity.
     *
     * @Route("/{id}", name="platos_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Platos $plato)
    {
        $form = $this->createDeleteForm($plato);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($plato);
            $em->flush();
        }

        return $this->redirectToRoute('platos_index');
    }

    /**
     * Creates a form to delete a plato entity.
     *
     * @param Platos $plato The plato entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Platos $plato)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('platos_delete', array('id' => $plato->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
