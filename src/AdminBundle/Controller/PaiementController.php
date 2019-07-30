<?php

namespace AdminBundle\Controller;

use AdminBundle\Entity\Paiement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Clientpro controller.
 *
 * @Route("admin/paiement")
 */
class PaiementController extends Controller
{
    /**
     * Afficher le paiement d'un client p/p à une session
     * @Route("/{id_session}/{id_user}", name="afficher_paiement")
     */
    public function afficherPaiementAction($id_session,$id_user)
    {
        $repository1 = $this->getDoctrine()->getRepository('AdminBundle:User');
        $repository2 = $this->getDoctrine()->getRepository('AdminBundle:Session');
        $user = $repository1->findOneById($id_user);
        $session = $repository2->findOneById($id_session);
        $conn = $this->getDoctrine()->getManager()->getConnection();
        $sql = "SELECT * FROM test.paiement WHERE user_id =? AND session_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array($id_user,$id_session));
        $paiement = $stmt->fetch();


        return $this->render('@Admin/PaiementController/afficher_paiement.html.twig', array(
            'paiement' => $paiement,
        ));
    }

    /**
     * Modifier le paiement d'un participant/client pour une session
     * @Route("/edit/{id_session}/{id_user}", name="edit_paiement", requirements={"id_session"="\d+", "id_user"="\d+"})
     */
    public function editPaiementAction(Request $request,$id_session,$id_user)
    {
        $conn = $this->getDoctrine()->getManager()->getConnection();
        $sql = "SELECT id FROM test.paiement WHERE user_id =? AND session_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array($id_user,$id_session));
        $pay = $stmt->fetch();
        $paiement_id = $pay['id'];
        $repo = $this->getDoctrine()->getRepository(Paiement::class);
        $paiement = $repo->findOneById($paiement_id);

        $editForm = $this->createForm('AdminBundle\Form\PaiementType', $paiement);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success','Modification faite');
            //return $this->redirectToRoute('afficher_user', array('id' => $id_session));
            $this->redirectToRoute('afficher_user',[
                    'id' => $id_session,
                ]
            );
        }

        return $this->render('@Admin/PaiementController/edit_paiement.html.twig', array(
            'id_session' => $id_session,
            'edit_form' => $editForm->createView(),
    ));
    }

}
