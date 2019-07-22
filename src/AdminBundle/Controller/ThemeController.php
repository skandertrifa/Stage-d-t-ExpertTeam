<?php

namespace AdminBundle\Controller;

use AdminBundle\Entity\Theme;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Theme controller.
 *
 */
class ThemeController extends Controller
{
    /**
     * Lists all theme entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $themes = $em->getRepository('AdminBundle:Theme')->findAll();

        return $this->render('theme/index.html.twig', array(
            'themes' => $themes,
        ));
    }

    /**
     * Creates a new theme entity.
     *
     */
    public function newAction(Request $request)
    {
        $theme = new Theme();
        $form = $this->createForm('AdminBundle\Form\ThemeType', $theme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($theme);
            $em->flush();
            $this->addFlash('success','Thème ajouté');
            return $this->redirectToRoute('theme_index');
        }

        return $this->render('theme/new.html.twig', array(
            'theme' => $theme,
            'form' => $form->createView(),
        ));
    }



    /**
     * Displays a form to edit an existing theme entity.
     *
     */
    public function editAction(Request $request, Theme $theme)
    {
        $editForm = $this->createForm('AdminBundle\Form\ThemeType', $theme);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success','Modification faite !');

            return $this->redirectToRoute('theme_index');
        }

        return $this->render('theme/edit.html.twig', array(
            'theme' => $theme,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a theme entity.
     *
     */
    public function deleteAction(Theme $theme)
    {
        if ($theme == null) {
            throw $this->createNotFoundException('thème introuvable');
        }
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($theme);
        $entityManager->flush();
        $this->addFlash('success','Thème supprimé');

        return $this->redirectToRoute('theme_index');
    }


}
