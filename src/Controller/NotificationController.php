<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\NotificationRepository;
use App\Entity\Notification ;
use App\Entity\User;

class NotificationController extends AbstractController
{
    /**
     * @Route("/notification", name="notification")
     */
    public function index(NotificationRepository $notification)
    {
        $user = 4;
        $profil = $this->getDoctrine()->getRepository(User::class)->find($user);
        $sql = 'SELECT DISTINCT (notification.id) , notification.titre, notification.contenu , notification.date_publication
        FROM type_habitat,habitat,domaine,notification
        WHERE type_habitat.id = habitat.id_type_habitat_id
        AND domaine.id = habitat.id_domaine_id 
        AND type_habitat.id = notification.id_type_habitat
        AND domaine.id_proprietaire_id  = '.$user.'
        AND notification.id_type_habitat IN (SELECT habitat.id_type_habitat_id
                                           FROM habitat)
        ORDER BY notification.date_publication DESC';
        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);

        $stmt->execute();
        $notification->countBy($user);


        return $this->render('userinterface/alertes.html.twig', [
            'controller_name' => 'NotificationController', 'notifs' => $stmt , 'profil' => $profil
        ]);
    }


    


}
