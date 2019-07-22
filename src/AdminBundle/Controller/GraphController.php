<?php

namespace AdminBundle\Controller;

use AdminBundle\Entity\ClientPro;
use AdminBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Graph controller.
 *
 * @Route("graph")
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

}
