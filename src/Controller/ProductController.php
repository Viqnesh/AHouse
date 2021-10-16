<?php

namespace App\Controller;

use App\Entity\Habitat;
use App\Entity\Region;
use App\Entity\Occupant;
use App\Entity\TypeHabitat;
use App\Entity\Coordonnees;
use App\Entity\Commentaire;
use App\Entity\PriseDeVue;
use App\Entity\Location;
use App\Entity\ActiviteHabitat;
use App\Form\CommentaireType;
use App\Form\OccupantType;
use App\Form\CoordonneesType;
use App\Form\Location1Type;
use App\Form\LocationOccupantType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use App\Repository\CommentaireRepository;
use App\Repository\PriseDeVueRepository;
use App\Repository\HabitatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse ;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Session;



class ProductController extends AbstractController
{
    
    /**
     * @Route("/listHabitat", name="listHabitat")
     */
    public function liste(HabitatRepository $habitatRepository): Response
    {

        $user = $this->getUser();
        $typehabitats = $this->getDoctrine()->getRepository(TypeHabitat::class)->findAll();
        $liste = $this->getDoctrine()->getRepository(Habitat::class)->findAll();
        
        return $this->render('product/listeHabitat.html.twig', [
            'controller_name' => 'ProductController', 
            'habitats' => $liste, 'typehabitats' => $typehabitats

        ]);
    }

    /**
     * @Route("/listeRecherche/{habitat}/{region}/{capacite}", name="listeRecherche", methods={"POST","GET"})
     */
    public function listeRecherche(int $habitat , string $region , int $capacite): Response
    {

        $regionObj = $this->getDoctrine()->getRepository(Region::class)->findOneBy(['id' => 2 ]); 
        $liste = $this->getDoctrine()->getRepository(Habitat::class)->findBy(['idTypeHabitat' => $habitat , 'region' => $regionObj->getId() , 'capacite' => $capacite]);    
        return $this->render('product/listeHabitat.html.twig', [
            'controller_name' => 'ProductController', 
            'habitats' => $liste,

        ]);

    }
        /**
     * @Route("/failed", name="failed")
     */
    public function failed(): Response
    {


        $this->addFlash(
            'warning',
            'Your changes were saved!'
        );
        return $this->render('internaute.html.twig', [
            'controller_name' => 'StripeController',
        ]);
    }
    
    /**
     * @Route("/success", name="success")
     */
    public function success(): Response
    {

        $this->addFlash(
            'success',
            'Your changes were saved!'
        );

        return $this->render('internaute.html.twig', [
            'controller_name' => 'StripeController',
        ]);
    }
     /**
     * @Route("/product/{id}", name="product", methods={"GET","POST"})
     */
    public function product(int $id, CommentaireRepository $commentRepository, PriseDeVueRepository $prisedevueRepository, Request $request): Response
    {

        $habitats = $this->getDoctrine()->getRepository(Habitat::class)->find($id);
        $comments = $this->getDoctrine()->getRepository(Commentaire::class)->findBy(
            ['idHabitatIdCommentaire' => $habitats->getId() ],
            ['id' => 'DESC']
        );

        $photo = $this->getDoctrine()->getRepository(PriseDeVue::class)->findAll($id);
        $activite =  $this->getDoctrine()->getRepository(ActiviteHabitat::class)->findAll($id);
        $location = new Location();
        $user = $this->getUser();
        $location->setIdUserLocataire($user);
        $location->setIdHabitatIdLocation($habitats);
        $comment = new Commentaire();
        $comment->setIdUser($user);
        $comment->setIdHabitatIdCommentaire($habitats);
        $formComment = $this->createForm(CommentaireType::class, $comment);
        $formReservation = $this->createForm(Location1Type::class, $location);
        $formComment->handleRequest($request);
        if ($formComment->isSubmitted() && $formComment->isValid()) {

            $comment = $formComment->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comment);
            $entityManager->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            return $this->redirectToRoute('product' , array('id' => $id));

        }
        $formReservation->handleRequest($request);

        if ($formReservation->isSubmitted() && $formReservation->isValid()) {

            $location = $formReservation->getData();
            $comment = $formComment->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($location);
            $entityManager->flush();



// sets a HTTP response header

// prints the HTTP headers followed by the content
            return $this->redirectToRoute('reserver' , array('id' => $location->getId()));



            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

    }

    
    return $this->render('product/index.html.twig', [
        'controller_name' => 'ProductController',
        'formComment' => $formComment->createView(),
        'formLocation' => $formReservation->createView(),
        'habitats' => $habitats,
        'comments' => $comments,
        'photos' => $photo,
        'activites' => $activite
    ]);
    }
    /**
     * @Route("/reserver/{id}", name="reserver", methods={"POST","GET"})
     */
    public function reserver(int $id): Response
    {

        $location = new Location();
        $depart = $this->get('session')->get('depart');
        $arrivee = $this->get('session')->get('arrivee');
        $nbpersonne = $this->get('session')->get('occupant');
        // dummy code - add some example tags to the task
        // (otherwise, the template will render an empty list of tags)
        // create 20 products! Bam!
        for ($i = 0; $i < $nbpersonne; $i++) {
            $occupants[$i] = new Occupant() ;
            $occupants[$i]->setType('Bébé');
            $location->getOccupants()->add($occupants[$i]);
        }
        $dateDifference = $arrivee->diff($depart);


        // end dummy code

        $form = $this->createForm(LocationOccupantType::class, $location);
        $request = Request::createFromGlobals();
        $form->handleRequest($request);


        $habitat= $this->getDoctrine()->getRepository(Habitat::class)->findOneBy(['id' => $id ]);
        $coordonnees= $this->createForm(CoordonneesType::class);
        $occupant= $this->createForm(OccupantType::class);

        if ($form->isSubmitted() && $form->isValid()) {
            

            $tabOccupants = $form->get('occupants')->getData();
            $nbOccupants = count($tabOccupants); 
            $prixttc = $habitat->getPrix() * $dateDifference->days ;
            $this->get('session')->set('infosOccupants', $tabOccupants);
            $this->get('session')->set('nbOccupants', $nbOccupants);
            $this->get('session')->set('prixTTC', $prixttc);
            return $this->redirectToRoute('coordonnees' , array('id' => $id ));


        }



        return $this->render('product/reserver.html.twig', [
            'controller_name' => 'ProductController', 
            'habitats' => $habitat,
            'form' => $form->createView(),
            'depart' => $depart,
            'arrivee' => $arrivee,
            'occupant' => $occupant->createView(),
            'nuits'=> $dateDifference,
        ]);
    }
    /**
     * @Route("/coordonnees/{id}", name="coordonnees", methods={"POST","GET"})
     */
    public function coordonnees(int $id): Response
    {
        $coordonnees = new Coordonnees(); 
        $form = $this->createForm(CoordonneesType::class, $coordonnees);
        $habitat= $this->getDoctrine()->getRepository(Habitat::class)->findOneBy(['id' => $id ]);
        $request = Request::createFromGlobals();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            

            $tabOccupants = $form->getData();
            $this->get('session')->set('coordonnees', $coordonnees);
            return $this->redirectToRoute('payment' , array('id' => $id ));


        }
        return $this->render('coordonnees.html.twig', [
            'controller_name' => 'ProductController', 
            'habitats' => $habitat,
            'form' => $form->createView(),

        ]);

    }

    /**
     * @Route("/payment/{id}", name="payment", methods={"POST","GET"})
     */

     public function payment(int $id): Response {

        $habitat= $this->getDoctrine()->getRepository(Habitat::class)->findOneBy(['id' => $id ]);
        return $this->render('payments.html.twig', [
            'controller_name' => 'ProductController', 
            'habitats' => $habitat,

        ]);
     }
    /**
     * @Route("/create-checkout-session", name="checkout")
     */
    public function checkout(Request $request): JsonResponse
    {

        $request->request->all();
        
        \Stripe\Stripe::setApiKey('sk_test_51Hee2yJHgf7eKHPKBEGByNDQYoQVhXZico8knwYSOc3nfwxyiuAbzOLaVFSEY09JqMMaGlNNu6QJAQACN1nByybc00an0FeVe4');
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
            'price_data' => [
            'currency' => 'eur',
            'unit_amount' => 12000,
            'product_data' => [
            'name' => 'Mobile Home de',
            'images' => ["public/images/userDefault.svg"],
            ],
            ],
            'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => $this->generateUrl('internaute' , [], UrlGeneratorInterface::ABSOLUTE_URL),
             'cancel_url' => $this->generateUrl('internaute' , [], UrlGeneratorInterface::ABSOLUTE_URL),
            ]);

        return $response = new JsonResponse(['id' => $session->id ]);
    }

}
