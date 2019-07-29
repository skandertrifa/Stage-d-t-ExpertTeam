<?php

namespace AdminBundle\Controller;

use AdminBundle\Entity\Formateur;
use AdminBundle\Entity\Session;
use AdminBundle\Entity\User;
use AdminBundle\Form\SessionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Tests\Extension\Core\Type\DateTypeTest;
use Symfony\Component\HttpFoundation\Request;

class GererSessionController extends Controller
{
    //***************************************************

    // Ajouter une session

    //***************************************************
    public function ajouterSessionAction(Request $request)
    {
        $session = new Session();
        $form = $this->createForm(SessionType::class,$session);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $session = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($session);
            $entityManager->flush();
            // redirection for sucess message !!!!!!!!!!
            $this->addFlash('success', 'La session a été créée');
            return $this->redirectToRoute('afficher_session');
        }

        return $this->render('@Admin/GererSession/ajouter_session.html.twig',
        array(
                'form' => $form->createView()
        ));
    }
    //***************************************************

    // Afficher les sessions qui ont été crées

    //***************************************************

    public function afficherSessionAction()
    {
        $repo = $this->getDoctrine()->getRepository(Session::class);
        $sessions = $repo->findAll();


        return $this->render('@Admin/GererSession/afficher_session.html.twig', array(
            'sessions' => $sessions,
        ));
    }

    //***************************************************

    // Supprimer une session existante !

    //***************************************************


    public function supprimerSessionAction($id)
    {
        $repo = $this->getDoctrine()->getRepository(Session::class);
        $session = $repo->findOneById($id);
        if ($session == null ) {
            throw $this->createNotFoundException('Session introuvable');
        }
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($session);
        $entityManager->flush();

        return $this->redirectToRoute('afficher_session');
    }

    //***************************************************

    // Affecter des utilisateurs à des session déja existantes !

    //***************************************************


    public function editerSessionAction($id,Request $request)
    {

        $repo = $this->getDoctrine()->getRepository(Session::class);
        $session = $repo->findOneById($id);

       // $form = $this->createForm(SessionType::class,$session);

        switch ($session->getEtat()){
            case "planifié":
                $choix = array(
                    'planifié' => 'planifié',
                    'retardé' => 'retardé',
                    'en cours' => 'en cours',
                    'annulé' => 'annulé',
                );
                break;
            case "retardé":
                $choix = array(
                    'retardé' => 'retardé',
                    'en cours' => 'en cours',
                    'annulé' => 'annulé',
                );
                break;
            case "en cours":
                $choix = array(
                    'en cours' => 'en cours',
                    'terminé' => 'terminé' ,
                );
                break;
            case "annulé":
                $choix = array(
                    'annulé' => 'annulé',
                    'terminé' => 'terminé' ,
                );
                break;
            case "terminé":
                $choix = array(
                    'terminé' => 'terminé' ,
                );
                break;
        }

        $form = $this->createFormBuilder($session)
            ->add('nom',EntityType::class, [
                'class' => 'AdminBundle\Entity\Theme',
                'multiple' => false,
                'expanded' => false,
            ])
            ->add('dateDebut',DateType::class,[
                    'widget' => 'single_text',
                ])
            ->add('dateFin',DateType::class, [
                    'widget' => 'single_text',
                ])
            ->add('etat',ChoiceType::class, [
                'choices'  => $choix,
                ] )
            ->add('valider',SubmitType::class)
            ->add('description')
            ->add('formateur',EntityType::class,[
                'class' => 'AdminBundle\Entity\Formateur',
                'multiple' => false,
                'expanded' => false,
            ])
            ->getForm();




        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $session = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($session);
            $entityManager->flush();
            $this->addFlash('success', 'Modification faite !');

            return $this->redirectToRoute('afficher_session');
        }



        return $this->render('@Admin/GererSession/edit_session.html.twig', array(
            'form' => $form->createView()
        ));
    }

    //***************************************************

    // Afficher les utilisateurs de la session !!!

    //***************************************************

    public function afficherUserAction($id)
    {

        // requête sql pour chercher les clients de la session
        $entityManager = $this->getDoctrine()->getManager();
        $conn = $entityManager->getConnection();
        $sql = 'SELECT * FROM test.fos_user WHERE id IN (SELECT user_id FROM paiement WHERE session_id=? )';
        $stmt = $conn->prepare($sql);
        $stmt->execute(array($id));
        $clients = $stmt->fetchAll();

        return $this->render('@Admin/GererSession/afficher_user.html.twig', array(
            'users' => $clients,
            'id_session' => $id,
        ));
    }

    //***************************************************

    // Affecter des utilisateurs à des session déja existantes !

    //***************************************************

    public function affecterUserAction()
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $users = $repository->findAll();
        $enityManager = $this->getDoctrine()->getManager();


        return $this->render('@Admin/GererSession/affecter_user.html.twig', array(
                'users' => $users,
        ));
    }

    //***************************************************

    // Afficher tous les utilisateurs non affecté à cette session de formation ( réstants) !

    //***************************************************
    public function afficherTousLesUsersAction($id)
    {
        //$repository = $this->getDoctrine()->getRepository(User::class);
        //$users = $repository->findAll();
        // requête sql pour chercher les clients de la session(conjugé)
        $entityManager = $this->getDoctrine()->getManager();
        $conn = $entityManager->getConnection();
        $sql = 'SELECT * FROM test.fos_user WHERE id NOT IN (SELECT user_id FROM paiement WHERE session_id=? )';
        $stmt = $conn->prepare($sql);
        $stmt->execute(array($id));
        $clients = $stmt->fetchAll();


        return $this->render('@Admin/GererSession/afficher_all_users.html.twig', array(
            'users' => $clients,
            'session_id' => $id,
        ));
    }
    //***************************************************

    // ajouter un utilisateur à une session

    //***************************************************
    public function addUserToSessionAction ($id_session,$id_user)
    {
            /*$repo = $this->getDoctrine()->getRepository(Session::class);
            $session = $repo->findOneById($id_session);
            $repo2 = $this->getDoctrine()->getRepository(User::class);
            $user = $repo2->findOneById($id_user);

            $session->addUser($user);
            $user->addSession($session);
            /*dump($session);
            dump($user);
            die();*/
            $entityManager = $this->getDoctrine()->getManager();
            $conn = $entityManager->getConnection();
            $sql = 'INSERT INTO test.paiement (`session_id`, `user_id`) VALUES (?, ?)';
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                $id_session,
                $id_user,
            ]);
            return $this->redirectToRoute('afficher_user',[
                    'id' => $id_session,
                ]
                );

    }
    //***************************************************

    //  supprimer un utilisateur d'une session

    //***************************************************
    public function removeUserFromSessionAction ($id_session,$id_user)
    {
        $conn = $this->getDoctrine()->getManager()->getConnection();
        $sql = 'DELETE FROM test.paiement WHERE test.paiement.session_id = ? AND test.paiement.user_id = ? ';
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            $id_session,
            $id_user,
        ]);


        return $this->redirectToRoute('afficher_user',[
                'id' => $id_session,
            ]
        );
    }

    //***************************************************

    //  relancer un participant (qui n'a pas payé par exemple )

    //***************************************************

    public function relancerParticipantAction ($email)
    {
        $message = (new \Swift_Message('Un petit rappel'));
        $message->setFrom('skander.trifa2@gmail.com')
                ->setTo($email)
                ->setBody('Test Swift Mailer !', 'text/html');
        $this->get('mailer')->send($message);
        $this->addFlash('success', 'Email de relance envoyé !');

        return $this->redirectToRoute('afficher_session');

    }

}
