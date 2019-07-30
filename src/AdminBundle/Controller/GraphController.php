<?php

namespace AdminBundle\Controller;

use AdminBundle\Entity\ClientPro;
use AdminBundle\Entity\Paiement;
use AdminBundle\Entity\Session;
use AdminBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Graph controller.
 *
 * @Route("admin/graph")
 */
class GraphController extends Controller
{
    /**
     * @Route("/")
     */
    public function showAction()
    {
        //todo SQL stmt to calculate the numbers and pass them to the charts


        $repository = $this->getDoctrine()->getRepository(User::class);

        $particuliers = $repository->getCountType('Particulier');
        $vermegs = $repository->getCountClientPro('Vermeg');

        $sofrecoms =$repository->getCountClientPro('Sofrecom');
        $LOUPS =$repository->getCountClientPro('LOUP');


        return $this->render('@Admin/Graph/show.html.twig', array(
            'particuliers' => $particuliers,
            'vermgs' => $vermegs,
            'sofrecoms' =>$sofrecoms,
            'LOUPS' => $LOUPS,
        ));
    }
    /**
     * @Route("/session/{id_session}" ,name="show_paiement_chart")
     */
    public function showPaiementChartAction($id_session)
    {
        //todo SQL stmt to calculate % of paiement of a session


        $repository = $this->getDoctrine()->getRepository(Paiement::class);


        $payes = $repository->getCount('Payé',$id_session);
        $non_payes = $repository->getCount('Non payé',$id_session);
        $partiel = $repository->getCount('Partiel',$id_session);
        $total = $repository->getCountTotal($id_session);



        return $this->render('@Admin/Graph/show_paiement_chart.html.twig', array(
            'payes' => $payes,
            'non_payes' => $non_payes,
            'partiel' =>$partiel,
            'total' => $total,
        ));
    }

}
