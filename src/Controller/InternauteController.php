<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Habitat;
use App\Entity\ActiviteHabitat;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Entity\User;
use App\Entity\PriseDeVue;
use App\Entity\Region;

use App\Entity\Commentaire;
use App\Entity\Domaine;
use App\Entity\TypeHabitat;
use App\Entity\Location;
use App\Form\SearchHabitatType;
use App\Form\ContactOwnerType;

use App\Form\PriseDeVueType;
use App\Form\CommentaireType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class InternauteController extends AbstractController
{
    /**
     * @Route("/internaute", name="internaute")
     */
    public function index()
    {
        $habitat = new Habitat() ;
        $activite = new ActiviteHabitat();
        $userId = 4 ; 
        $profil = $this->getDoctrine()->getRepository(User::class)->find($userId);
        $repository = $this->getDoctrine()->getRepository(Location::class);
        $historique = $repository->findBy([ 'idUserLocataire' => $userId]
        );
        //$this->denyAccessUnlessGranted('ROLE_USER');
        return $this->render('userinterface/dashboard.html.twig', [
            'habitat' => $habitat , 'activite' => $activite , 'historiques' => $historique, 'profil' => $profil
        ]);
    }

    /**
     * @Route("/home", name="home" , methods={"GET" ,"POST"})
     */
    public function home(Request $request)
    {

        $typehabitat = $this->getDoctrine()->getRepository(TypeHabitat::class)->findAll();
        $habitats = $this->getDoctrine()->getRepository(Domaine::class)->findAll();
        $recherche = new Habitat();
        $region = $this->getDoctrine()->getRepository(Region::class)->findAll();
        $form = $this->createForm(SearchHabitatType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $recherche = $form->getData();
            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            return $this->redirectToRoute('listeRecherche', ['habitat' => $recherche->getIdTypeHabitat()->getId() , 'region' => $recherche->getRegion()->getId() , 'capacite' => $recherche->getCapacite()]);

    }
        return $this->render('accueil/index.html.twig', [ 'habitats' => $habitats, 'regions' => $region ,'form' => $form->createView() ,'types' => $typehabitat
        ]);
    }



    /**
     * @Route("/listeDomaines", name="domaine_liste")
     */
    public function listeDomaine() {


        $types = $this->getDoctrine()->getRepository(Region::class)->findAll();

        return $this->render('etablissement/domaines.html.twig', [
            'controller_name' => 'InternauteController' , 'types' => $types
        ]);
    }

    /**
     * @Route("/hebergement", name="hebergements")
     */
    public function listeHebergement() {

        $typehabitat = $this->getDoctrine()->getRepository(TypeHabitat::class)->findAll();

        return $this->render('hebergements/hebergement.html.twig', [
            'controller_name' => 'InternauteController' ,'types' => $typehabitat
        ]);
    }

    /**
     * @Route("/domaines/locations/{id}", name="domaine_details")
     */
    public function listeLocations(int $id) {


        $contact = $this->createForm(ContactOwnerType::class);
        $domaine = $this->getDoctrine()->getRepository(Domaine::class)->find($id);
        $habitat= $this->getDoctrine()->getRepository(Habitat::class)->findby(
            [ 'idDomaine' => $id ]
        );
        if ($contact->isSubmitted() && $contact->isValid()) {
            $expediteur = $contact->get('email')->getData();
            $objet = $contact->get('objet')->getData();
            $contenu = $contact->get('contenu')->getData();
            $destinataire = $user->getEmail();
            $email = (new Email())
            ->from($expediteur)
            ->to('vignesht.pro@gmail.com')
            ->subject($objet)
            ->text($contenu);
            
            $mailer->send($email);

            return $this->redirectToRoute('habitat_domaines' , array('id' => $location->getId()));
        }

        return $this->render('etablissement/locations.html.twig', [
            'controller_name' => 'InternauteController' , 'domaine' => $domaine , 'habitats' => $habitat , 'contact' => $contact->createView() 
        ]);
    }

    /**
     * @Route("/listeHistorique", name="listeHistorique")
     */
    public function listeHistorique()
    {

        $userId = $this->getUser()->getId();
        $profil = $this->getDoctrine()->getRepository(User::class)->find($userId);
        $repository = $this->getDoctrine()->getRepository(Location::class);
        $user = $this->getDoctrine()->getRepository(User::class)->find($this->getUser()->getId());
        $historique = $repository->findby(['idUserLocataire' => $user , 'statut' => "Valide"]);

        
        return $this->render('userinterface/meslocations.html.twig', [
            'controller_name' => 'InternauteController', 'locations' => $historique   , 'profil' => $profil
        ]);
    }
    
    /**
     * @Route("/locations/comment", name="locations_comments")
     */
    public function locationsCommentaire()
    {

        $userId = 4;
        $profil = $this->getDoctrine()->getRepository(User::class)->find($userId);
        $repository = $this->getDoctrine()->getRepository(Location::class);
        $user = $this->getDoctrine()->getRepository(User::class)->find($userId);
        $historique = $repository->findby(['idUserLocataire' => $user , 'statut' => "Valide"]);

        
        return $this->render('userinterface/comment/listeLocation.html.twig', [
            'controller_name' => 'InternauteController', 'locations' => $historique   , 'profil' => $profil
        ]);
    }

    /**
     * @Route("/listeHistorique/details/{id}", name="listeHistorique_details")
     */
    public function showDetailsReservation(Request $request , int $id){


        $user = $this->getUser()->getId();
        $profil = $this->getDoctrine()->getRepository(User::class)->find($user);
        $habitat = $this->getDoctrine()->getRepository(Location::class)->find($id);

        $bien = $habitat->getIdHabitatIdLocation();
        $idBien = $bien->getId();
        $activite = $this->getDoctrine()->getRepository(ActiviteHabitat::class)->findby(['idHabitat' => $idBien]);
        $photo = $this->createForm(PriseDeVueType::class);
        $form = $this->createForm(CommentaireType::class);
        $commentaire = new Commentaire();
        $prisedevue = new PriseDeVue();

        $prisedevue->setIdHabitatIdPrisedevue($bien);


        $form->handleRequest($request);
        $photo->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $commentaire = $form->getData();
            $commentaire->setIdUser($this->getUser());
            $commentaire->setIdHabitatIdCommentaire($bien);
            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($commentaire);
            $entityManager->flush();

            return $this->redirectToRoute('listeHistorique_details', ['id' => $id ]);

        }       
        if ($photo->isSubmitted() && $photo->isValid()) {

            $imageurl = $photo->get('url')->getData();
            $fichier = md5(uniqid()) . '.' . $imageurl->guessExtension();
            $directory = $this->getParameter('photo_directory');
            $extension = $imageurl->guessExtension();
            $imageurl->move($directory, $fichier);
            $prisedevue->setUrl($fichier);
            $prisedevue->setIdHabitatIdPrisedevue($bien);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($prisedevue);
            $entityManager->flush();

            return $this->redirectToRoute('listeHistorique_details', ['id' => $id ]);

        }   
        
        return $this->render('userinterface/meslocationsdetails.html.twig', [
            'controller_name' => 'InternauteController', 'profil' => $profil , 'location' => $habitat , 'form' => $form->createView() , 'activites' => $activite , 'photo' => $photo->createView()
        ]);
    }

    /**
     * @Route("/reservationAttente/{id}", name="reservation_attente")
     */
    public function gererReservation(int $id)
    {
        $user = $this->getUser()->getId();
        $profil = $this->getDoctrine()->getRepository(User::class)->find($user);
        $reservation = $this->getDoctrine()->getRepository(Location::class)->findBy(['idHabitatIdLocation' => $id , 'statut' => 'En Attente']);

    
        return $this->render('userinterface/reservationHabitat.html.twig', [
            'controller_name' => 'InternauteController', 'locations' => $reservation , 'profil' => $profil]);
        }

    /**
    * @Route("/searchresult", name="searchresult")
    */
    public function searchResult() {



        return $this->render('searchresult.html.twig', [
            'controller_name' => 'InternauteController']);
    }

      
    /**
     * @Route("/valider/{idLocation}", name="valider")
     */
    public function valider(int $idLocation)
    {
        $repository = $this->getDoctrine()->getManager();
        $location = $repository->getRepository(Location::class)->find($idLocation);
        $idhabitat = $location->getIdHabitatIdLocation();
        $location->setStatut('Validé');
        $repository->flush();
        $this->addFlash('success', 'La réservation à bien été validé');
        return $this->redirectToRoute('reservation_attente' , ['id' => $idhabitat]);

    }

    
}
