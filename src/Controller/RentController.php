<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Domaine ;
use App\Entity\ActiviteHabitat;
use App\Entity\Activite;
use App\Entity\Habitat;
use App\Entity\Location;
use App\Entity\Commentaire;
use App\Entity\Calendrier;
use App\Form\Location1Type;
use App\Form\ContactOwnerType;
use App\Entity\PriseDeVue ;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Session\Session;

use Symfony\Component\Routing\Annotation\Route;

class RentController extends AbstractController
{
    /**
     * @Route("/rent", name="rent")
     */
    public function index(): Response
    {
        return $this->render('rent/index.html.twig', [
            'controller_name' => 'RentController',
        ]);
    }


    /**
     * @Route("/domaines/habitat/{id}", name="habitat_domaines")
     */
    public function voirHabitat(Request $request , int $id, MailerInterface $mailer) {

        $habitat= $this->getDoctrine()->getRepository(Habitat::class)->find($id);
        $domaine= $this->getDoctrine()->getRepository(Domaine::class)->findOneby(
            [ 'id' => $habitat->getIdDomaine() ]
        );
        $commentaire = $this->getDoctrine()->getRepository(Commentaire::class)->findby(
            [ 'idHabitatIdCommentaire' => $habitat->getId() ]
        );
        $photos = $this->getDoctrine()->getRepository(PriseDeVue::class)->findby(
            [ 'idHabitatIdPrisedevue' => $habitat->getId() ]
        );

        $location = new Location();
        $user = $this->getUser();
        $location->setIdUserLocataire($user);
        $location->setIdHabitatIdLocation($habitat);
        $activite = $this->getDoctrine()->getRepository(Activite::class)->findby(['idDomaine' => $id]);
        $formReservation = $this->createForm(Location1Type::class, $location);
        $dispoHabitat = $this->getDoctrine()->getRepository(Calendrier::class)->findBy([ 'idHabitat' => $id , 'etat' => 'D']);
        $dateOccupe = $this->getDoctrine()->getRepository(Calendrier::class)->findBy([ 'idHabitat' => $id , 'etat' => 'O']);


        $formReservation->handleRequest($request);

        if ($formReservation->isSubmitted() && $formReservation->isValid()) {
            $depart = $formReservation->get('dateDebut')->getData();
            $arrivee = $formReservation->get('dateFin')->getData();
            $occupant = $formReservation->get('nbpersonnes')->getData();
            $this->get('session')->set('depart', $depart);
            $this->get('session')->set('arrivee', $arrivee);
            $this->get('session')->set('occupant', $occupant);
            
            return $this->redirectToRoute('reserver' , array('id' => $id ));

        
            // ... further modify the response or return it directly
        

        }





        return $this->render('etablissement/habitat.html.twig', [
            'controller_name' => 'InternauteController' ,'comments' => $commentaire , 'rent' => $formReservation->createView() ,'activites' => $activite , 'habitats' => $habitat , 'domaines' => $domaine , 'photos' => $photos , 'datesHabitats' => $dispoHabitat , 'dateOccupes' => $dateOccupe ,
        ]);
    }

    /**
    * @Route("habitatactivite/{id}", name="habitat_activite")
    */
    public function showActivite(int $id) {


        $activite = $this->getDoctrine()->getRepository(ActiviteHabitat::class)->findOneBy(['typeActivite' => $id ]);
        $habitat = $activite->getIdHabitat();

        $commentaire = $this->getDoctrine()->getRepository(Commentaire::class)->findby(
            [ 'idActiviteHabitat' => $activite->getId() ]
        );
        $photos = $this->getDoctrine()->getRepository(PriseDeVue::class)->findby(
            [ 'idActiviteHabitat' => $activite->getId() ]
        );
        return $this->render('etablissement/activiteprhabitat.html.twig', [
            'controller_name' => 'InternauteController' , 'habitat' => $habitat ,'activite' => $activite , 'photos' => $photos , 'comments' => $commentaire 
        ]);
    }

}
