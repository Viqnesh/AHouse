<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository\UserRepository;
use App\Entity\User ;
use App\Entity\Habitat ;
use App\Entity\Location;
use App\Entity\Equipement;
use App\Entity\Commentaire;
use App\Entity\PriseDeVue;
use App\Util\UploadedBase64;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;

class ApiPostController extends AbstractController
{
    /**
     * @Route("userss", name="userss" , methods={"GET"})
     */
    public function index(SerializerInterface $serializer): JsonResponse
    {
        $user = $this->getDoctrine()->getRepository(User::class)->findAll();
        $json = $serializer->serialize($user, 'json' , ['groups' => 'user:read']);
        $response = new JsonResponse($json, 200, [], true);

        return $response;
    }
    /**
     * @Route("display/{id}" , name="display" , methods={"GET"})
     */
    public function gettroisNotifications(int $id, SerializerInterface $serializer): JsonResponse
    {
            $idLocataire = $this->getDoctrine()->getRepository(User::class)->findOneBy([ 'id' => $id ]);
            $sql = 'SELECT DISTINCT (notification.id) , notification.titre, notification.contenu , notification.date_publication
            FROM type_habitat,habitat,domaine,notification
            WHERE type_habitat.id = habitat.id_type_habitat_id
            AND domaine.id = habitat.id_domaine_id 
            AND type_habitat.id = notification.id_type_habitat
            AND domaine.id_proprietaire_id  = '.$id.'
            AND notification.id_type_habitat IN (SELECT habitat.id_type_habitat_id
                                               FROM habitat)
            ORDER BY notification.date_publication DESC
            LIMIT 3';
            $em = $this->getDoctrine()->getManager();
            $stmt = $em->getConnection()->prepare($sql);
    
            $stmt->execute();
            $json = $serializer->serialize($stmt, 'json' , ['groups' => 'notification:info']);
            $response = new JsonResponse($json, 200, [], true);
    
            return $response;
    }
    /**
     * @Route("utilisateurs/{id}" , name="usersid" , methods={"GET"})
     */
    public function getUsersInfo(int $id, SerializerInterface $serializer): JsonResponse
    {
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy([ 'id' => $id]);
        $json = $serializer->serialize($user, 'json' , ['groups' => 'location:info']);
        $response = new JsonResponse($json, 200, [], true);

        return $response;
    }

    /**
     * @Route("connexion", name="connexion" , methods={"POST"})
     */
    public function loginUser(SerializerInterface $serializer, Request $request,UserPasswordEncoderInterface $encoder) : JsonResponse
    {
        $email = $request->query->get('email');
        $password = $request->query->get('password');
        $user = $this->getDoctrine()->getRepository(User::class)->findBy([ 'password' => $password, 'email' => $email ]);
        $json = $serializer->serialize($user, 'json' , ['groups' => 'user:read']);
        $response = new JsonResponse($json, 200, [], true);
        return $response;
    }

    /**
     * @Route("habitatapp/{id}" , name="habitats_app" , methods={"GET"})
     */
    public function getHabitat(int $id, SerializerInterface $serializer): JsonResponse
    {
        $habitat = $this->getDoctrine()->getRepository(Habitat::class)->findBy([ 'id' => $id]);
        $json = $serializer->serialize($habitat, 'json' , ['groups' => 'location:info']);
        $response = new JsonResponse($json, 200, [], true);

        return $response;
    }

    /**
     * @Route("rental/{id}" , name="locations_app" , methods={"GET"})
     */
    public function getLocations(int $id, SerializerInterface $serializer): JsonResponse
    {
        $locataire = $this->getDoctrine()->getRepository(Location::class)->findBy([ 'idUserLocataire' => $id
]);
        $json = $serializer->serialize($locataire, 'json' , ['groups' => 'location:info']);
        $response = new JsonResponse($json, 200, [], true);

        return $response;
    }

    /**
     * @Route("equipement" , name="equipement_app" , methods={"GET"})
     */
    public function getEquipements(SerializerInterface $serializer): JsonResponse
    {
        $equiped = $this->getDoctrine()->getRepository(Equipement::class)->findAll();
        $json = $serializer->serialize($equiped, 'json' , ['groups' => 'location:info']);
        $response = new JsonResponse($json, 200, [], true);

        return $response;
    }
    /**
     * @Route("commentapp/{id}" , name="comment_app" , methods={"GET"})
     */
    public function getComments(int $id , SerializerInterface $serializer): JsonResponse
    {
        $comment = $this->getDoctrine()->getRepository(Commentaire::class)->findBy(['idHabitatIdCommentaire' => $id]);
        $json = $serializer->serialize($comment, 'json' , ['groups' => 'location:info']);
        $response = new JsonResponse($json, 200, [], true);

        return $response;
    }

    /**
     * @Route("photosapp/{id}" , name="photos_app" , methods={"GET"})
     */
    public function getPhotos(int $id , SerializerInterface $serializer): JsonResponse
    {
        $comment = $this->getDoctrine()->getRepository(PriseDeVue::class)->findBy(['idHabitatIdPrisedevue' => $id]);
        $json = $serializer->serialize($comment, 'json' , ['groups' => 'location:info']);
        $response = new JsonResponse($json, 200, [], true);

        return $response;
    }
    /**
     * @Route("addphotoapp" , name="photo_app_add" , methods={"POST"})
     */
    public function savePhotos(Request $request, SerializerInterface $serializer) : Response
    {
        $jsonRecu = $request->getContent();
        $photos = $serializer->deserialize($jsonRecu, PriseDeVue::class, 'json');
        $bien = $this->getDoctrine()->getRepository(Habitat::class)->findOneBy(['nom' => $photos->getIdHabitatIdPrisedevue()->getNom()]);
        $prisedevue = new PriseDeVue();
        $imageurl = $photos->getUrl();
        $img = "<img src= 'data:image/jpeg;base64, $imageurl' />";
        $fichier = md5(uniqid()).'.jpg';
        $directory = $this->getParameter('photo_directory');
        $success = file_put_contents($fichier, $img);
        $imageFile = new UploadedBase64($img, $fichier);
        $imageFile->move($directory, $fichier);
        $prisedevue->setUrl($fichier);
        $prisedevue->setIdHabitatIdPrisedevue($bien);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($prisedevue);
        $entityManager->flush();
        $response = new Response(
            'Content',
            Response::HTTP_OK,
            ['content-type' => 'text/html']
        );   
        return $response;
    }
    /**
     * @Route("addcommentapp" , name="comment_app_add" , methods={"POST"})
     */
    public function saveComment(Request $request, SerializerInterface $serializer)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $jsonRecu = $request->getContent();
        $comment = $serializer->deserialize($jsonRecu, Commentaire::class, 'json');
        $habitat = $this->getDoctrine()->getRepository(Habitat::class)->findOneBy(['nom' => $comment->getIdHabitatIdCommentaire()->getNom()]);
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['email' => $comment->getIdUser()->getEmail()]);
        $commentaire = new Commentaire();
        $commentaire->setTitre($comment->getTitre());
        $commentaire->setContenu($comment->getContenu());
        $commentaire->setIdHabitatIdCommentaire($habitat);
        $commentaire->setIdUser($user);
        $entityManager->persist($commentaire);
        $entityManager->flush();

    }

    /**
     * @Route("notifs/{id}" , name="notifs" , methods={"GET"})
     */
    public function getNotifications(int $id, SerializerInterface $serializer): JsonResponse
    {
        $idLocataire = $this->getDoctrine()->getRepository(User::class)->findOneBy([ 'id' => $id ]);
        $sql = 'SELECT DISTINCT (notification.id) , notification.titre, notification.contenu , notification.date_publication
        FROM type_habitat,habitat,domaine,notification
        WHERE type_habitat.id = habitat.id_type_habitat_id
        AND domaine.id = habitat.id_domaine_id 
        AND type_habitat.id = notification.id_type_habitat
        AND domaine.id_proprietaire_id  = '.$id.'
        AND notification.id_type_habitat IN (SELECT habitat.id_type_habitat_id
                                           FROM habitat)
        ORDER BY notification.date_publication DESC';
        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);

        $stmt->execute();
        $json = $serializer->serialize($stmt, 'json' , ['groups' => 'notification:info']);
        $response = new JsonResponse($json, 200, [], true);

        return $response;
    }
    /**
     * @Route("userlogin" , name="user_login_app" , methods={"POST"})
     */
    public function seConnecter(Request $request, SerializerInterface $serializer)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $jsonRecu = $request->getContent();
        $loginsession = $serializer->deserialize($jsonRecu, User::class, 'json');
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy([ 'password' => $loginsession->getPassword() , 'email' => $loginsession->getEmail() ]);
        $json = $serializer->serialize($user, 'json' , ['groups' => 'location:info']);
        $response = new JsonResponse($json, 200, [], true);

        return $response;
    }


}
