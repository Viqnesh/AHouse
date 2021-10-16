<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request ;
use App\Form\DomaineType;
use App\Entity\User;
use App\Entity\Region ;
use App\Entity\ActiviteHabitat;
use App\Entity\Habitat;
use App\Entity\Location ;
use App\Entity\Activite;
use App\Entity\ProprieteHabitat;
use App\Entity\Calendrier;
use App\Entity\DispoDomaine;
use App\Form\DispoDomaineType;
use App\Form\DispoLogementType;
use App\Form\CalendarHabitatType;
use App\Form\DomaineCalendrierType;
use Doctrine\Common\Collections\ArrayCollection;

use App\Form\User1Type;
use App\Form\ActiviteHabitatType;
use App\Form\ActiviteType;
use App\Form\HabitatType;
use App\Form\ProprieteHabitatType;
use App\Entity\PriseDeVue;
use App\Entity\Propriete;
use App\Entity\Commentaire;
use App\Form\PriseDeVueType;
use App\Form\CommentaireType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\Domaine ;
class ProfileController extends AbstractController
{
    /**
     * @Route("/profile", name="profile")
     */
    public function index(): Response
    {
        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
        ]);
    }
    /**
     * @Route("internaute/meshabitats/", name="internaute_habitats")
     */
    public function showHabitats() {


        $user = 4 ;
        $profil = $this->getDoctrine()->getRepository(User::class)->find($user);
        $domaine = $this->getDoctrine()->getRepository(Domaine::class)->findBy([ 'idProprietaire' => $user]); 
        $habitat = $this->getDoctrine()->getRepository(Habitat::class)->findBy([ 'idDomaine' => $domaine]);
        return $this->render('userinterface/meshabitats.html.twig', [
            'controller_name' => 'ProfileController', 'profil' => $profil , 'habitats' => $habitat 
        ]);
    }
        /**
     * @Route("internaute/{id}/meshabitats/new", name="internaute_habitats_new")
     */
    public function addHabitats(Request $request) {


        $user = $this->getUser()->getId();
        $profil = $this->getDoctrine()->getRepository(User::class)->find($user);
        $habitat = new Habitat();
        $repository = $this->getDoctrine()->getRepository(Domaine::class);
        $domaine = $repository->findOneBy([ 'idProprietaire' => $user]);
        $form = $this->createForm(HabitatType::class, $habitat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageurl = $form->get('url')->getData();
            $fichier = md5(uniqid()) . '.' . $imageurl->guessExtension();
            $directory = $this->getParameter('habitat_directory');
            $extension = $imageurl->guessExtension();
            $imageurl->move($directory, $fichier);


            $habitat->setUrl($fichier);
            $habitat->setPays('France');
            $habitat->setIdDomaine($domaine);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($habitat);
            $entityManager->flush();

            return $this->redirectToRoute('internaute_habitats_details', array( 'id' => $habitat->getId()));
        }
        return $this->render('userinterface/addhabitat.html.twig', [
            'controller_name' => 'ProfileController', 'profil' => $profil , 'habitat' => $habitat , 'form' => $form->createView(),

        ]);
    }
    /**
     * @Route("internaute/meshabitats/{id}", name="internaute_habitats_details")
     */
    public function detailsHabitats(int $id) {


        $user = 4 ;
        $profil = $this->getDoctrine()->getRepository(User::class)->find($user);
        $habitat = $this->getDoctrine()->getRepository(Habitat::class)->find($id);

        $repository = $this->getDoctrine()->getRepository(Domaine::class);
        $domaine = $repository->findOneBy([ 'idProprietaire' => $user]);
        $type = $habitat->getIdTypeHabitat();
        $propriete = $this->getDoctrine()
        ->getRepository(Propriete::class)
        ->findby(['idTypeHabitat' => $type]);
        $proprieteHabitats = $this->getDoctrine()
        ->getRepository(ProprieteHabitat::class)
        ->findby(['IdHabitatPropriete' => $id]);
        $activite = $this->getDoctrine()->getRepository(Activite::class)->findBy([ 'idDomaine' => $domaine ]);
        $activiteHabitat = $this->getDoctrine()->getRepository(ActiviteHabitat::class)->findby(
            ['idHabitat' => $id],
            ['typeActivite' => 'ASC']
    );
        return $this->render('userinterface/meshabitatsdetails.html.twig', [
            'controller_name' => 'ProfileController', 'activites' => $activite ,'proprietes' => $propriete ,'profil' => $profil , 'proprieteHabitats' => $proprieteHabitats , 'habitat' => $habitat , 'activiteHabitats' => $activiteHabitat
        ]);
    }

    /**
     * @Route("internaute/meshabitats/{id}/calendar", name="internaute_habitats_calendar")
     */
    public function gererCalenderier(int $id) {

        $user = $this->getUser()->getId();
        $profil = $this->getDoctrine()->getRepository(User::class)->find($user);
        $domaine = $this->getDoctrine()->getRepository(Domaine::class)->findOneBy([ 'idProprietaire' => $user]);
        $dispoDomaine = $this->getDoctrine()->getRepository(DispoDomaine::class)->findBy([ 'idDomaine' => $domaine]);
        $habitat = $this->getDoctrine()->getRepository(Habitat::class)->find($id);
        $dispoHabitat = $this->getDoctrine()->getRepository(Calendrier::class)->findBy([ 'idHabitat' => $id]);
        if (empty($dispoHabitat)) {
            for ($i=0; $i <= count($dispoDomaine) ; $i++) { 
                $dateHabitat = new Calendrier();
                $dateHabitat->setDateDispo( $dispoDomaine[$i]->getDateDispo());
                $dateHabitat->setEtat("D");
                $dateHabitat->setIdHabitat($habitat);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($dateHabitat);
                $entityManager->flush();
            }
        }


        $dateUpdate = $this->getDoctrine()->getRepository(Calendrier::class)->findBy([ 'idHabitat' => $id ]) ;
        $originalDates = new ArrayCollection();
        for ($i=0; $i < count($dispoDomaine) ; $i++) { 
            $date = $dispoDomaine[$i];
            $originalDates->add($date);
        }
        $form = $this->createForm(DispoLogementType::class);
        $request = Request::createFromGlobals();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $taille = count($form->get('dateDispo'));
            for ($i=0; $i < $taille ; $i++) { 
                
                $dateUpdate[$i]->setEtat($form->get('dateDispo')->getData()[$i]->getEtat());
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->flush();

            }
            return $this->redirectToRoute('internaute_habitats_calendar', array( 'id' => $habitat->getId() ));
        }    



        return $this->render('userinterface/calendarhabitat.html.twig', [
            'controller_name' => 'ProfileController',
            'form' => $form->createView(),
            'dateDomaines' => $originalDates,

        ]);
    }


    /**
     * @Route("internaute/meshabitats/{id}/edit", name="internaute_habitats_edit")
     */
    public function editHabitats(int $id, Request $request) {


        $user = $this->getUser()->getId();
        $profil = $this->getDoctrine()->getRepository(User::class)->find($user);
        $habitat = $this->getDoctrine()->getRepository(Habitat::class)->find($id);
        $form = $this->createForm(HabitatType::class, $habitat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageurl = $form->get('url')->getData();
            $fichier = md5(uniqid()) . '.' . $imageurl->guessExtension();
            $directory = $this->getParameter('habitat_directory');
            $extension = $imageurl->guessExtension();
            $imageurl->move($directory, $fichier);
            $habitat->setUrl($fichier);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('internaute_habitats_details', array( 'id' => $habitat->getId()));
        }
        return $this->render('userinterface/meshabitatsedit.html.twig', [
            'controller_name' => 'ProfileController', 'profil' => $profil , 'habitat' => $habitat , 'form' => $form->createView(),

        ]);
    }


    /**
     * @Route("internaute/{idHabitat}/activite/{id}/edit", name="internaute_activite_edit")
     */
    public function editActivite(int $id, Request $request, int $idHabitat) {


        $user = $this->getUser()->getId();
        $profil = $this->getDoctrine()->getRepository(User::class)->find($user);
        $habitat = $this->getDoctrine()->getRepository(Habitat::class)->find($idHabitat);
        $activite = $this->getDoctrine()->getRepository(Activite::class)->find($id);
        $activiteHabitat = new ActiviteHabitat();
        $form = $this->createForm(ActiviteHabitatType::class, $activiteHabitat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $activiteHabitat = $form->getData();
            $activiteHabitat->setTypeActivite($activite);
            $activiteHabitat->setIdHabitat($habitat);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($activiteHabitat);
            $entityManager->flush();
            return $this->redirectToRoute('internaute_habitats_details', array( 'id' => $habitat->getId()));
        }
        return $this->render('userinterface/activite_edit.html.twig', [
            'controller_name' => 'ProfileController', 'profil' => $profil , 'habitat' => $habitat, 'activite' => $activiteHabitat , 'form' => $form->createView(),

        ]);

    
    }

    /**
     * @Route("internaute/mondomaine/", name="internaute_domaine")
    */
    public function showDomaine() {

        $user = 4 ;
        $profil = $this->getDoctrine()->getRepository(User::class)->find($user);
        $repository = $this->getDoctrine()->getRepository(Domaine::class);
        $domaine = $repository->findBy([ 'idProprietaire' => $user]);
        $activite = $this->getDoctrine()->getRepository(Activite::class)->findBy([ 'idDomaine' => $domaine ]);

        
        return $this->render('userinterface/mondomaine.html.twig', [
            'controller_name' => 'ProfileController', 'domaines' => $domaine , 'profil' => $profil , 'activites' => $activite
        ]);
    }
    /**
     * @Route("internaute/mondomaine/{id}/calendar", name="internaute_domaine_calendar")
     */
    public function gererCalenderierDomaine(int $id) {

        $user = $this->getUser()->getId();
        $profil = $this->getDoctrine()->getRepository(User::class)->find($user);
        $domaine = $this->getDoctrine()->getRepository(Domaine::class)->findOneBy([ 'idProprietaire' => $user]);
        $habitats = $this->getDoctrine()->getRepository(Habitat::class)->findBy([ 'idDomaine' => $domaine]);
        $dispoDomaine = $this->getDoctrine()->getRepository(DispoDomaine::class)->findBy([ 'idDomaine' => $domaine]);
        $originalDates = new Domaine() ;
        for ($i=0; $i < count($dispoDomaine) ; $i++) { 
            $date[$i] = $dispoDomaine[$i];
            $originalDates->getDispoDomaine()->add($date[$i]);
        }
        $form = $this->createForm(DomaineCalendrierType::class, $originalDates);
        $request = Request::createFromGlobals();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $taille = count($form->get('dispoDomaine'));

            // Ajout des Dates
            for ($i=0; $i < $taille ; $i++) { 
                $dateDispo = $form->get('dispoDomaine')->getData()[$i] ;
                $dateDispo->setIdDomaine($domaine) ;
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($dateDispo);
                $entityManager->flush();

            }
            //Ajout des Dates pour chaque logement
            foreach ($habitats as $habitat) {
                for ($i=0; $i < $taille ; $i++) { 
                    $dispoHabitat = new Calendrier();
                    $dispoHabitat->setIdHabitat($habitat);
                    $dispoHabitat->setDateDispo($form->get('dispoDomaine')->getData()[$i]->getDateDispo());
                    $dispoHabitat->setEtat("D");
                    $dispoHabitatBDD = $this->getDoctrine()->getRepository(Calendrier::class)->findOneBy([ 'idHabitat' => $habitat->getId() , 'dateDispo' => $form->get('dispoDomaine')->getData()[$i]->getDateDispo() ]);
                    if ($dispoHabitatBDD == null) {
                        $entityManager->persist($dispoHabitat);
                        $entityManager->flush();
                    }
                }
            }


            //Suppression des Dates 
            foreach ($dispoDomaine as $dates) {
                if (false === $originalDates->getDispoDomaine()->contains($dates)) {
                    $entityManager->remove($dates);
                    $entityManager->flush();

                }
            }

            return $this->redirectToRoute('internaute_domaine_calendar', array( 'id' => $domaine->getId() ));


            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated

            // ... perform some action, such as saving the task to the database


        }       



        return $this->render('userinterface/calendardomaine.html.twig', [
            'controller_name' => 'ProfileController',
            'form' => $form->createView(),
            'dispoDomaine' => $dispoDomaine,

        ]);
    }
        /**
     * @Route("internaute/mondomaine/new", name="internaute_domaine_new")
     */
    public function addDomaine(Request $request) {


        $user = $this->getUser()->getId();
        $profil = $this->getDoctrine()->getRepository(User::class)->find($user);
        $domaine = new Domaine();
        $form = $this->createForm(DomaineType::class, $domaine);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageurl = $form->get('image')->getData();
            $fichier = md5(uniqid()) . '.' . $imageurl->guessExtension();
            $directory = $this->getParameter('domaine_directory');
            $extension = $imageurl->guessExtension();
            $imageurl->move($directory, $fichier);
            $domaine->setImage($fichier);
            $entityManager = $this->getDoctrine()->getManager();
            $domaine->setIdProprietaire($this->getUser());
            $entityManager->persist($domaine);
            $entityManager->flush();
            return $this->redirectToRoute('internaute_domaine');
        }
        return $this->render('userinterface/adddomaine.html.twig', [
            'controller_name' => 'ProfileController', 'profil' => $profil , 'form' => $form->createView(),

        ]);
    }
    /**
     * @Route("internaute/mondomaine/{id}/edit", name="internaute_domaine_edit" , methods={"GET","POST"})
     */
    public function editDomaine(Request $request, Domaine $domaine) {

        $user = $this->getUser()->getId();
        $profil = $this->getDoctrine()->getRepository(User::class)->find($user);
        $form = $this->createForm(DomaineType::class, $domaine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageurl = $form->get('image')->getData();
            $fichier = md5(uniqid()) . '.' . $imageurl->guessExtension();
            $directory = $this->getParameter('domaine_directory');
            $extension = $imageurl->guessExtension();
            $imageurl->move($directory, $fichier);
            $domaine->setImage($fichier);
            $domaine->setPays('France');
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('internaute_domaine');
        }

        return $this->render('userinterface/domainedit.html.twig', [
            'domaine' => $domaine,
            'form' => $form->createView(),
            'profil' => $profil
        ]);
    }
    /**
     * @Route("internaute/profil/{id}/edit", name="internaute_profil_edit" , methods={"GET","POST"})
     */
    public function editProfil(Request $request, User $user, UserPasswordEncoderInterface $encoder) {

        $form = $this->createForm(User1Type::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageurl = $form->get('url')->getData();
            $motdepasse = $form->get('password')->getData();
            $fichier = md5(uniqid()) . '.' . $imageurl->guessExtension();
            $directory = $this->getParameter('profil_directory');
            $extension = $imageurl->guessExtension();
            $imageurl->move($directory, $fichier);
            $encoded = $encoder->encodePassword($user, $motdepasse);
            $user->setUrl($fichier);
            $user->setPassword($encoded);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('internaute');
        }

        return $this->render('userinterface/editprofile.html.twig', [
            'profil' => $user,
            'form' => $form->createView(),
        ]);
    }
        /**
     * @Route("internaute/location", name="internaute_location")
     */
    public function showLocation() {

        $idUser = 4 ;
        $profil = $this->getDoctrine()->getRepository(User::class)->find($idUser);
        $repository = $this->getDoctrine()->getRepository(Location::class);
        $user = $this->getDoctrine()->getRepository(User::class)->find($idUser);
        $historique = $repository->findby(['idUserLocataire' => $user , 'statut' => "En Attente"]);
        
        
        return $this->render('userinterface/showLocation.html.twig', [
            'controller_name' => 'InternauteController', 'locations' => $historique , 'profil' => $profil
        ]);

    }
    /**
     * @Route("internaute/location/activite/{id}", name="internaute_location_activite")
     */
    public function showActivite(int $id, Request $request) {

        $activite = $this->getDoctrine()->getRepository(ActiviteHabitat::class)->find($id);
        $photos = $this->getDoctrine()->getRepository(PriseDeVue::class)->findby(
            [ 'idActiviteHabitat' => $activite->getId() ]
        );
        $user = $this->getUser()->getId();
        $profil = $this->getDoctrine()->getRepository(User::class)->find($user);
        $photo = $this->createForm(PriseDeVueType::class);
        $form = $this->createForm(CommentaireType::class);
        $commentaire = new Commentaire();
        $prisedevue = new PriseDeVue();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $commentaire = $form->getData();
            $commentaire->setIdUser($this->getUser());
            $commentaire->setIdActiviteHabitat($activite);
            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($commentaire);
            $entityManager->flush();

            return $this->redirectToRoute('internaute_location_activite', ['id' => $activite->getId() ]);

        }       
        if ($photo->isSubmitted() && $photo->isValid()) {

            $prisedevue = $photo->getData();
            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($prisedevue);
            $entityManager->flush();

            return $this->redirectToRoute('internaute_location_activite', ['id' => $activite->getId() ]);

        }   
        
        return $this->render('userinterface/activitedetailsuser.html.twig', [
            'controller_name' => 'InternauteController' , 'profil' => $profil , 'activite' => $activite , 'form' => $form->createView() , 'photo' => $photo->createView()
        ]);

    }

    /**
     * @Route("internaute/{id}/propriete", name="internaute_propriete_index", methods={"GET"})
    */
    public function showProperty(int $id, Request $request): Response
    {
        
        $user = $this->getUser()->getId();
        $profil = $this->getDoctrine()->getRepository(User::class)->find($user);
        $habitat = $this->getDoctrine()->getRepository(Habitat::class)->find($id);
        $proprieteForm = $this->createForm(ProprieteHabitatType::class); 
        $type = $habitat->getIdTypeHabitat();
        $proprieteForm->handleRequest($request);
        $proprieteHabitats = $this->getDoctrine()
        ->getRepository(Propriete::class)
        ->findby(['idTypeHabitat' => $type]);
        return $this->render('propriete_habitat/index.html.twig', [
            'propriete_habitats' => $proprieteHabitats, 'profil' => $profil, 'form' => $proprieteForm->createView(), 'habitat' => $habitat
        ]);
    }
    /**
     * @Route("internaute/propriete/{idHabitat}/{id}/edit", name="internaute_propriete_edit" , methods={"GET", "POST"})
     */
    public function editProperty(int $id, Request $request, int $idHabitat): Response
    {
        $user = $this->getUser()->getId();
        $profil = $this->getDoctrine()->getRepository(User::class)->find($user);
        $proprieteForm = $this->createForm(ProprieteHabitatType::class); 
        $habitat = $this->getDoctrine()->getRepository(Habitat::class)->find($idHabitat);
        $proprieteForm->handleRequest($request);
        $proprieteHabitats = $this->getDoctrine()->getRepository(Propriete::class)->findOneby(['id' => $id]);
        if ($proprieteForm->isSubmitted() && $proprieteForm->isValid()) {
            $data = $proprieteForm->get('valeurPropriete')->getData();
            $propriete = new ProprieteHabitat();
            $propriete->setIdHabitatPropriete($habitat);
            $propriete->setIdPropriete($proprieteHabitats);
            $propriete->setValeurPropriete($data);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($propriete);
            $entityManager->flush();
            return $this->redirectToRoute('internaute_propriete_index');
        }
        return $this->render('propriete_habitat/edit.html.twig', [
            'propriete' => $proprieteHabitats, 'profil' => $profil, 'form' => $proprieteForm->createView(),
        ]);
    }
    /**
     * @Route("internaute/mondomaine/{id}/activite", name="internaute_domaine_activite")
    */
    public function showActivityDomaine(int $id) {

        $user = $this->getUser()->getId();
        $profil = $this->getDoctrine()->getRepository(User::class)->find($user);
        $repository = $this->getDoctrine()->getRepository(Activite::class);
        $repository2 = $this->getDoctrine()->getRepository(Domaine::class);
        $domaine = $repository2->findBy([ 'idProprietaire' => $user]);
        $activite = $this->getDoctrine()->getRepository(Activite::class)->find($id);
        return $this->render('userinterface/activitedomaine/show.html.twig', [
            'controller_name' => 'ProfileController', 'activite' => $activite , 'profil' => $profil
        ]);
    }

    /**
     * @Route("internaute/activite/domaine/new", name="domaine_activite_new")
    */
    public function newActivityDomaine(Request $request){

        
        $user = $this->getUser()->getId();
        $profil = $this->getDoctrine()->getRepository(User::class)->find($user);
        $domaine = $this->getDoctrine()->getRepository(Domaine::class)->findOneBy([ 'idProprietaire' => $user ]);
        $activite = new Activite();
        $form = $this->createForm(ActiviteType::class, $activite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageurl = $form->get('image')->getData();
            $fichier = md5(uniqid()) . '.' . $imageurl->guessExtension();
            $directory = $this->getParameter('activite_directory');
            $extension = $imageurl->guessExtension();
            $imageurl->move($directory, $fichier);
            $activite->setImage($fichier);
            $activite->setIdDomaine($domaine);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($activite);
            $entityManager->flush();
            return $this->redirectToRoute('internaute_domaine');
        }
        
        return $this->render('userinterface/activitedomaine/new.html.twig', [
            'controller_name' => 'ProfileController' , 'profil' => $profil , 'form' => $form->createView()
        ]);
    }

    /**
     * @Route("internaute/activite/domaine/{id}/edit", name="domaine_activite_edit")
    */
    public function editActivityDomaine(Request $request , Activite $activite) {
        $user = $this->getUser()->getId();
        $profil = $this->getDoctrine()->getRepository(User::class)->find($user);
        $form = $this->createForm(ActiviteType::class, $activite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageurl = $form->get('image')->getData();
            $fichier = md5(uniqid()) . '.' . $imageurl->guessExtension();
            $directory = $this->getParameter('activite_directory');
            $extension = $imageurl->guessExtension();
            $imageurl->move($directory, $fichier);
            $activite->setImage($fichier);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($activite);
            $entityManager->flush();
            return $this->redirectToRoute('internaute_activite');
        }


        return $this->render('userinterface/activitedomaine/edit.html.twig', [
            'controller_name' => 'ProfileController', 'activite' => $activite , 'profil' => $profil , 'form' => $form->createView()
        ]);
    }

}
