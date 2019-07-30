<?php

namespace AdminBundle\Controller;

use AdminBundle\Entity\Formateur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Formateur controller.
 *
 * @Route("/admin/session/formateur")
 */
class FormateurController extends Controller
{
    /**
     * Lists all formateur entities.
     *
     * @Route("/", name="formateur_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $formateurs = $em->getRepository('AdminBundle:Formateur')->findAll();

        return $this->render('formateur/index.html.twig', array(
            'formateurs' => $formateurs,
        ));
    }

    /**
     * Creates a new formateur entity.
     *
     * @Route("/new", name="formateur_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $formateur = new Formateur();
        $form = $this->createForm('AdminBundle\Form\FormateurType', $formateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($formateur);
            $em->flush();
            $this->addFlash('success','Formateur ajouté');

            return $this->redirectToRoute('formateur_index');
        }

        return $this->render('formateur/new.html.twig', array(
            'formateur' => $formateur,
            'form' => $form->createView(),
        ));
    }


    /**
     * Displays a form to edit an existing formateur entity.
     *
     * @Route("/{id}/edit", name="formateur_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Formateur $formateur)
    {
        $editForm = $this->createForm('AdminBundle\Form\FormateurType', $formateur);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success','Modification faite');
            return $this->redirectToRoute('formateur_edit', array('id' => $formateur->getId()));
        }

        return $this->render('formateur/edit.html.twig', array(
            'formateur' => $formateur,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a formateur entity.
     *
     * @Route("/{id}", name="formateur_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Formateur $formateur)
    {

        if ($formateur == null) {
            throw $this->createNotFoundException('formateur introuvable');
        }
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($formateur);
        $entityManager->flush();
        $this->addFlash('success','Formateur supprimé');

        return $this->redirectToRoute('formateur_index');

    }

}


