<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use App\Entity\Habitat ;
use App\Form\ContactOwnerType;
use App\Entity\PriseDeVue ;
use Symfony\Component\Routing\Annotation\Route;
class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $user = $this->getUser();
        $contact = $this->createForm(ContactOwnerType::class);
        $contact->handleRequest($request);

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

            return $this->redirectToRoute('home');
        }
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController', 'contact' => $contact->createView()
        ]);
    }
    /**
     * @Route("/contact_owner/{id}", name="contact_owner")
     */
    public function sendEmail(Habitat $habitats, MailerInterface $mailer)
    {

        $habitat = new Habitat();
        $user = $this->getUser();
        $form = $this->createForm(ContactType::class, $habitat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $envoyeur = $habitat->getIdProprietaire()->getEmail();
            $destinataire = $user->getEmail();
            $email = (new Email())
            ->from($envoyeur)
            ->to($destinataire)
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject($data['sujet'])
            ->text($data['contenu']);
            
            $mailer->send($email);

            return $this->redirectToRoute('listHabitat');
        }

        return $this->render('contact/index.html.twig', [
            'habitat' => $habitat,
            'form' => $form->createView(),

        ]);

        // ...
}
}