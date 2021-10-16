<?php

namespace App\Controller;

use App\Entity\ProprieteHabitat;
use App\Entity\User;
use App\Form\ProprieteHabitatType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/proprietehabitat")
 */
class ProprieteHabitatController extends AbstractController
{
    /**
     * @Route("/", name="propriete_habitat_index", methods={"GET"})
     */
    public function index(): Response
    {
        
        $user = $this->getUser()->getId();
        $profil = $this->getDoctrine()->getRepository(User::class)->find($user);
        $proprieteHabitats = $this->getDoctrine()
            ->getRepository(ProprieteHabitat::class)
            ->findAll();

        return $this->render('propriete_habitat/index.html.twig', [
            'propriete_habitats' => $proprieteHabitats, 'profil' => $profil
        ]);
    }

    /**
     * @Route("/new", name="propriete_habitat_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $proprieteHabitat = new ProprieteHabitat();
        $form = $this->createForm(ProprieteHabitatType::class, $proprieteHabitat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($proprieteHabitat);
            $entityManager->flush();

            return $this->redirectToRoute('propriete_habitat_index');
        }

        return $this->render('propriete_habitat/new.html.twig', [
            'propriete_habitat' => $proprieteHabitat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="propriete_habitat_show", methods={"GET"})
     */
    public function show(ProprieteHabitat $proprieteHabitat): Response
    {
        return $this->render('propriete_habitat/show.html.twig', [
            'propriete_habitat' => $proprieteHabitat,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="propriete_habitat_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ProprieteHabitat $proprieteHabitat): Response
    {
        $form = $this->createForm(ProprieteHabitatType::class, $proprieteHabitat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('propriete_habitat_index');
        }

        return $this->render('propriete_habitat/edit.html.twig', [
            'propriete_habitat' => $proprieteHabitat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="propriete_habitat_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ProprieteHabitat $proprieteHabitat): Response
    {
        if ($this->isCsrfTokenValid('delete'.$proprieteHabitat->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($proprieteHabitat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('propriete_habitat_index');
    }
}
