<?php

namespace App\Controller;

use App\Entity\Propriete;
use App\Entity\Notification;
use App\Entity\ProprieteHabitat;
use App\Form\Propriete1Type;
use App\Repository\ProprieteRepository;
use App\Repository\ProprieteHabitatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/propriete")
 */
class ProprieteController extends AbstractController
{
    /**
     * @Route("/", name="propriete_index", methods={"GET"})
     */
    public function index(ProprieteRepository $proprieteRepository): Response
    {
        return $this->render('propriete/index.html.twig', [
            'proprietes' => $proprieteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="propriete_new", methods={"POST"})
     */
    public function new(Request $request): Response
    {
        $propriete = new Propriete();
        $notification = new Notification();
        $propriete_habitat = new ProprieteHabitat();
        $notification->setTitle("Ajout d'un paramètre");
        $form = $this->createForm(Propriete1Type::class, $propriete);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($propriete);

            $propriete_habitat->setIdPropriete($propriete->getId());
            $entityManager->persist($propriete_habitat);
            $notification->setContenu("Un nouveau paramètre vient d'être ajouté pour les ".$propriete->getIdTypeHabitat() );
            $notification->setTypeHabitat($propriete->getIdTypeHabitat());

            $entityManager->persist($notification);
            $entityManager->flush();
            return $this->redirectToRoute('propriete_index');
        }

        return $this->render('propriete/new.html.twig', [
            'propriete' => $propriete,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="propriete_show", methods={"GET"})
     */
    public function show(Propriete $propriete): Response
    {
        return $this->render('propriete/show.html.twig', [
            'propriete' => $propriete,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="propriete_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Propriete $propriete): Response
    {
        $form = $this->createForm(Propriete1Type::class, $propriete);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('propriete_index');
        }

        return $this->render('propriete/edit.html.twig', [
            'propriete' => $propriete,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="propriete_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Propriete $propriete): Response
    {
        if ($this->isCsrfTokenValid('delete'.$propriete->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($propriete);
            $entityManager->flush();
        }

        return $this->redirectToRoute('propriete_index');
    }
}
