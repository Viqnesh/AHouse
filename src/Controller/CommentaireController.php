<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Repository\CommentaireRepository;
use App\Form\Commentaire1Type;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/commentaire")
 */
class CommentaireController extends AbstractController
{
    /**
     * @Route("/newComment/{idReservation}", name="commentaire_new", methods={"GET","POST"})
     */
    public function new(Reservation $reservation): Response
    {
        $commentaire = new Commentaire();
        $form = $this->createForm(Commentaire1Type::class, $commentaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($commentaire);
            $entityManager->flush();

            $this->addFlash('success', 'Votre commentaire a bien été posté !');

            return $this->redirectToRoute('internaute');

        }

        return $this->render('commentaire/new.html.twig', [
            'commentaire' => $commentaire,
            'form' => $form->createView(),
        ]);
    

        }

    /**
     * @Route("/newComment/{idHabitat}", name="commentaire_new", methods={"GET","POST"})
     */
    public function newCommentActivites(ActiviteHabitat $activiteHabitat): Response
    {
        $commentaire = new Commentaire();
        $form = $this->createForm(Commentaire1Type::class, $commentaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($commentaire);
            $entityManager->flush();

            return $this->redirectToRoute('commentaire_index');
        }

        return $this->render('commentaire/newActiviteComment.html.twig', [
            'commentaire' => $commentaire,
            'form' => $form->createView(),
        ]);
    

    }


    /**
     * @Route("/", name="comment_index", methods={"GET"})
     */
    public function index(CommentaireRepository $CommentaireRepository): Response
    {
        return $this->render('commentaire/index.html.twig', [
            'commentaires' => $CommentaireRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="comment_show", methods={"GET"})
     */
    public function show(Commentaire $comment): Response
    {
        return $this->render('commentaire/show.html.twig', [
            'commentaires' => $comment,
        ]);
    }
}
