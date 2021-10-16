<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Habitat;
use App\Entity\TypeHabitat;
use App\Entity\Activite;
use App\Entity\Notification ;
use App\Entity\User;
use App\Form\TypeHabitatType;
use App\Form\ProprieteType;
use App\Form\Activite1Type;
use App\Entity\Commentaire;
use App\Entity\ProprieteHabitat ;
use App\Form\Propriete1Type;
use App\Entity\Propriete;
use App\Entity\Location;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\LocationRepository;
use App\Repository\HabitatRepository;
use App\Repository\TypeHabitatRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Repository\ProprieteRepository;
use App\Repository\ActiviteRepository;
use App\Repository\UserRepository;
use App\Repository\PriseDeVueRepository;
use App\Repository\CommentaireRepository;


/**
 * @Route("/gerant")
 */
class GerantController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index(): Response
    {
        $habitat = $this->getDoctrine()->getRepository(Habitat::class)->findAll();
        $proprietes = $this->getDoctrine()->getRepository(Propriete::class)->findAll() ;
        $comments = $this->getDoctrine()->getRepository(Commentaire::class)->findAll();
        $location = $this->getDoctrine()->getRepository(Location::class);
        $repoUser =  $this->getDoctrine()->getRepository(User::class);
        $repoBien = $this->getDoctrine()->getRepository(Habitat::class);
        $user = $repoUser->createQueryBuilder('u')
        // Filter by some parameter if you want
        // ->where('a.published = 1')
        ->select('count(u.id)')
        ->getQuery()
        ->getSingleScalarResult();
        $bien = $repoBien->createQueryBuilder('b')
        // Filter by some parameter if you want
        // ->where('a.published = 1')
        ->select('count(b.id)')
        ->getQuery()
        ->getSingleScalarResult();
        $loc = $location->createQueryBuilder('l')
        // Filter by some parameter if you want
        ->select('count(l.id)')
        ->getQuery()
        ->getSingleScalarResult();



        return $this->render('backoff.html.twig', [
            'controller_name' => 'GerantController', 'locations' => $loc , 'habitats' => $habitat , 'proprietes' => $proprietes , 'comments' => $comments , 'users' => $user , 'biens' => $bien
        ]);
    }

    /**
     * @Route("/habitat", name="habitat")
     */
    public function habitat(HabitatRepository $habitatRepository): Response
    {
        return $this->render('habitat_backoff.html.twig', [
            'controller_name' => 'GerantController', 'habitats' => $habitatRepository->findAll()
        ]);
    }   
    
    /**
     * @Route("/typeActivites", name="typeActivites", methods={"GET"})
     */
    public function typesActivites(ActiviteRepository $activiteRepository): Response
    {
        return $this->render('typeActivite.html.twig', [
            'controller_name' => 'GerantController', 'typeActivites' => $activiteRepository->findAll()
        ]);
    }
    /**
     * @Route("/proprietes", name="proprietes" , methods={"DELETE"})
     */
    public function proprietes(ProprieteRepository $proprieteRepository): Response
    {
        return $this->render('proprietes_backoff.html.twig', [
            'controller_name' => 'GerantController', 'proprietes' => $proprieteRepository->findAll()
        ]);
    }
    /**
     * @Route("/proprietes/add", name="proprietes/add")
     */
    public function addProprietes(Request $request): Response
    {

        $propriete = new Propriete();
        $notification = new Notification();
        $form = $this->createForm(ProprieteType::class, $propriete);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $form->getData();
            
            $nomParam = $form->get('nom')->getData();
            $habitatType = $form->get('idTypeHabitat')->getData()->getNom();
            $type = $form->get('type')->getData();
            $obligatoire = $form->get('obligatoire')->getData();
            if ($obligatoire == true) {
                $obligatoire = "oui" ;
            }
            else {
                $obligatoire = "non" ;
            }
            $entryData = array(
                'category' => $habitatType
              , 'format'    => $type
              , 'obligatoire'    => $obligatoire
              , 'nomParam'    => $nomParam
              , 'type'  => 'ajout'
            );
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($propriete);
            $entityManager->flush();

            //Ajout d'une notification
            $notification->setTitre("Ajout d'un paramètre");
            $parametre = $propriete->getIdTypeHabitat()->getNom() ;
            $notification->setContenu("Un nouveau paramètre à été ajouté pour les ".$parametre);
            $notification->setIdTypeHabitat($propriete->getIdTypeHabitat());
            $entityManager->persist($notification);
            $entityManager->flush();

            // Notification Stuff
            $context = new \ZMQContext();
            $socket = $context->getSocket(\ZMQ::SOCKET_PUSH, 'my pusher');
            $socket->connect("tcp://localhost:5555");
        
            $socket->send(json_encode($entryData));
            return $this->redirectToRoute('proprietes');
    

        }


        return $this->render('proprietes_add.html.twig', [
            'controller_name' => 'GerantController', 'propriete' => $propriete, 'form' => $form->createView(),
        ]);
    }

        /**
     * @Route("/{id}/edit", name="proprietes_edit", methods={"GET","POST"})
     */
    public function editProperty(Request $request, Propriete $propriete): Response
    {
        $form = $this->createForm(Propriete1Type::class, $propriete);
        $form->handleRequest($request);
        $notification = new Notification();


        if ($form->isSubmitted() && $form->isValid()) {

            $nomParam = $form->get('nom')->getData();
            $habitatType = $form->get('idTypeHabitat')->getData()->getNom();
            $type = $form->get('type')->getData();
            $obligatoire = $form->get('obligatoire')->getData();
            if ($obligatoire == true) {
                $obligatoire = "oui" ;
            }
            else {
                $obligatoire = "non" ;
            }
            $entryData = array(
                'category' => $habitatType
              , 'format'    => $type
              , 'obligatoire'    => $obligatoire
              , 'nomParam'    => $nomParam
              , 'type'  => 'modification'
            );

            $notification->setTitre("Modification d'un paramètre");
            $entityManager = $this->getDoctrine()->getManager();
            $parametre = $propriete->getIdTypeHabitat()->getNom() ;
            $notification->setContenu("Un paramètre à été modifié pour les ".$parametre);
            $notification->setIdTypeHabitat($propriete->getIdTypeHabitat());
            $entityManager->persist($notification);
            $entityManager->flush();

            $this->getDoctrine()->getManager()->flush();

            // Notification Stuff
            $context = new \ZMQContext();
            $socket = $context->getSocket(\ZMQ::SOCKET_PUSH, 'my pusher');
            $socket->connect("tcp://localhost:5555");
        
            $socket->send(json_encode($entryData));
            return $this->redirectToRoute('proprietes');
        }

        return $this->render('propriete/edit.html.twig', [
            'propriete' => $propriete,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/proprietes/{id}", name="proprietes_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Propriete $propriete): Response
    {
        if ($this->isCsrfTokenValid('delete'.$propriete->getId(), $request->request->get('_token'))) {
            
            $nomParam = $propriete->getNom();
            $habitatType = $propriete->getIdTypeHabitat()->getNom();
            $type = $propriete->getType();
            $obligatoire = $propriete->getObligatoire();
            if ($obligatoire == true) {
                $obligatoire = "oui" ;
            }
            else {
                $obligatoire = "non" ;
            }
            $entryData = array(
                'category' => $habitatType
              , 'format'    => $type
              , 'obligatoire'    => $obligatoire
              , 'nomParam'    => $nomParam
              , 'type'  => 'modification'
            );


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($propriete);
            $entityManager->flush();
            $notification->setTitre("Supprimer d'un paramètre");
            $parametre = $propriete->getIdTypeHabitat()->getNom() ;
            $notification->setContenu("Un paramètre à été supprimé pour les ".$parametre);
            $notification->setIdTypeHabitat($propriete->getIdTypeHabitat());
            $entityManager->persist($notification);
            $entityManager->flush();
        }

        return $this->redirectToRoute('proprietes');
    }
    /**
     * @Route("/comments", name="comments")
     */
    public function comments(CommentaireRepository $commentaireRepository): Response
    {
        return $this->render('comment_backoff.html.twig', [
            'controller_name' => 'GerantController', 'comments' => $commentaireRepository->findAll()
        ]);
    }
    
    /**
     * @Route("/photos", name="photos")
     */
    public function photos(PriseDeVueRepository $prisedevueRepository): Response
    {
        return $this->render('photos_backoff.html.twig', [
            'controller_name' => 'GerantController', 'photos' => $prisedevueRepository->findAll()
        ]);
    }
       /**
     * @Route("/{id}", name="typesActivites_show", methods={"GET"})
     */
    public function show(Activite $activite): Response
    {
        return $this->render('typeActivite_show.html.twig', [
            'activites' => $activite 
        ]);
    }
    /**
     * @Route("/typeActivites/add", name="typeActivites/add" , methods={"GET","POST"})
     */
    public function addTypeActivite(Request $request): Response
    {

        $activite = new Activite();
        $form = $this->createForm(Activite1Type::class, $activite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($activite);
            $entityManager->flush();

            return $this->redirectToRoute('typeActivites');
        }

        return $this->render('typeActivite_add.html.twig', [
            'controller_name' => 'GerantController', 'activite' => $activite, 'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/{id}", name="typesActivites_edit", methods={"GET","POST"})
     */
    public function edit(Activite $activite, Request $request): Response
    {
        $form = $this->createForm(Activite1Type::class, $activite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('typesActivites');
        }

        return $this->render('typesActivites_edit.html.twig', [
            'activites' => $activite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/typesActivites/{id}", name="typeActivites_delete", methods={"DELETE"})
     */
    public function deleteTypeActivite(Activite $activite, Request $request): Response
    {
        if ($this->isCsrfTokenValid('delete'.$activite->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($activite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('typeActivites');
    }
}
