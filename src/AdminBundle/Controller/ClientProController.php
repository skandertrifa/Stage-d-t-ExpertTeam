<?php

namespace AdminBundle\Controller;

use AdminBundle\Entity\ClientPro;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Clientpro controller.
 *
 * @Route("admin/clientpro")
 */
class ClientProController extends Controller
{
    /**
     * Lists all clientPro entities.
     *
     * @Route("/", name="clientpro_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $clientPros = $em->getRepository('AdminBundle:ClientPro')->findAll();

        return $this->render('clientpro/index.html.twig', array(
            'clientPros' => $clientPros,
        ));
    }

    /**
     * Creates a new clientPro entity.
     *
     * @Route("/new", name="clientpro_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $clientPro = new Clientpro();
        $form = $this->createForm('AdminBundle\Form\ClientProType', $clientPro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($clientPro);
            $em->flush();

            return $this->redirectToRoute('clientpro_index');
        }

        return $this->render('clientpro/new.html.twig', array(
            'clientPro' => $clientPro,
            'form' => $form->createView(),
        ));
    }


    /**
     * Displays a form to edit an existing clientPro entity.
     *
     * @Route("/{id}/edit", name="clientpro_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ClientPro $clientPro)
    {
        $editForm = $this->createForm('AdminBundle\Form\ClientProType', $clientPro);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('clientpro_edit', array('id' => $clientPro->getId()));
        }

        return $this->render('clientpro/edit.html.twig', array(
            'clientPro' => $clientPro,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a clientPro entity.
     *
     * @Route("/{id}", name="clientpro_delete")
     * @Method("DELETE")
     */
    public function deleteAction(ClientPro $clientPro)
    {
        if ($clientPro == null) {
            throw $this->createNotFoundException('client pro introuvable');
        }
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($clientPro);
        $entityManager->flush();
        $this->addFlash('success', 'Le client pro est supprimé');

        return $this->redirectToRoute('clientpro_index');
    }
}