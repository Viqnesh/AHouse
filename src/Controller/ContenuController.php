<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\NewsletterType;
use App\Entity\Newsletter ;

class ContenuController extends AbstractController
{
    /**
     * @Route("/contenu", name="contenu")
     */
    public function index(): Response
    {
        return $this->render('contenu/index.html.twig', [
            'controller_name' => 'ContenuController',
        ]);
    }
    /**
     * @Route("/questions", name="questions")
     */
    public function showFaq() {

        return $this->render('contenu/faq.html.twig', [
            'controller_name' => 'ContenuController',
        ]);
    }
    /**
     * @Route("/searchfaq", name="searchfaq")
     */
    public function showFaqSearch() {

        return $this->render('contenu/faq/search_hab.html.twig', [
            'controller_name' => 'ContenuController',
        ]);
    }
    /**
     * @Route("/bookingfaq", name="bookingfaq")
     */
    public function showFaqBooking() {

        return $this->render('contenu/faq./reservation_hab.html.twig', [
            'controller_name' => 'ContenuController',
        ]);
    }
    /**
     * @Route("/calendarfaq", name="calendarfaq")
     */
    public function showFaqCalendar() {

        return $this->render('contenu/faq/dispo_hab.html.twig', [
            'controller_name' => 'ContenuController',
        ]);
    }
    /**
     * @Route("/validerfaq", name="validerfaq")
     */
    public function showFaqValider() {

        return $this->render('contenu/faq/valider_res.html.twig', [
            'controller_name' => 'ContenuController',
        ]);
    }
    /**
     * @Route("/gererfaq", name="gererfaq")
     */
    public function showFaqGerer() {

        return $this->render('contenu/faq/gerer_hab.html.twig', [
            'controller_name' => 'ContenuController',
        ]);
    }
    /**
     * @Route("/paymentfaq", name="paymentfaq")
     */
    public function showFaqPayment() {

        return $this->render('contenu/faq/infos_payment.html.twig', [
            'controller_name' => 'ContenuController',
        ]);
    }
    /**
     * @Route("/aboutsus", name="about_us")
     */
    public function showAbout() {

        return $this->render('contenu/faq.html.twig', [
            'controller_name' => 'ContenuController',
        ]);
    }
    /**
     * @Route("/mentions-legales", name="mentions_legales")
     */
    public function showMentions() {



        return $this->render('contenu/mentions.html.twig', [
            'controller_name' => 'ContenuController',
        ]);
    }
        /**
     * @Route("/newsletter", name="newsletter")
     */
    public function newsletter(Request $request) {

        $newsletter = new Newsletter();
        $form = $this->createForm(NewsletterType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $newsletter = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newsletter);
            $entityManager->flush();
            return $this->redirectToRoute('home');
        }
        return $this->render('contenu/newsletter.html.twig', [
            'controller_name' => 'ContenuController', 'form' => $form->createView()
        ]);
    }

}
