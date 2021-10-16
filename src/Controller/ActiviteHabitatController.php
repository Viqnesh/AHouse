<?php

namespace App\Controller;

use App\Entity\ActiviteHabitat;
use App\Entity\Habitat;
use App\Form\ActiviteHabitat1Type;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/activite/habitat")
 */
class ActiviteHabitatController extends AbstractController
{
    /**
     * @Route("/{id}", name="activite_habitat_index", methods={"GET"})
     */
    public function index(int $id): Response
    {
        $activiteHabitats = $this->getDoctrine()->getRepository(ActiviteHabitat::class)->findBy(['idHabitat' => $id ]);
        $habitat = $this->getDoctrine()->getRepository(Habitat::class)->find($id);
        return $this->render('activite_habitat/index.html.twig', [
            'activite_habitats' => $activiteHabitats,
            'habitat' => $habitat
        ]);
    }

    /**
     * @Route("{id}/new", name="activite_habitat_new", methods={"GET","POST"})
     */
    public function new(int $id , Request $request): Response
    {
        $activiteHabitat = new ActiviteHabitat();
        $habitat = $this->getDoctrine()->getRepository(Habitat::class)->find($id);
        $form = $this->createForm(ActiviteHabitat1Type::class, $activiteHabitat);
        $activiteHabitat->setIdHabitat($habitat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($activiteHabitat);
            $entityManager->flush();

            return $this->redirectToRoute('/habitat' );
        }

        return $this->render('activite_habitat/new.html.twig', [
            'activite_habitat' => $activiteHabitat,
            'form' => $form->createView(),
            'habitat' => $habitat,
        ]);
    }

    /**
     * @Route("/{idActiviteH}", name="activite_habitat_show", methods={"GET"})
     */
    public function show(ActiviteHabitat $activiteHabitat): Response
    {
        return $this->render('activite_habitat/show.html.twig', [
            'activite_habitat' => $activiteHabitat,
        ]);
    }

    /**
     * @Route("/{idActiviteH}/edit", name="activite_habitat_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ActiviteHabitat $activiteHabitat): Response
    {
        $form = $this->createForm(ActiviteHabitat1Type::class, $activiteHabitat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('activite_habitat_index');
        }

        return $this->render('activite_habitat/edit.html.twig', [
            'activite_habitat' => $activiteHabitat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idActiviteH}", name="activite_habitat_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ActiviteHabitat $activiteHabitat): Response
    {
        if ($this->isCsrfTokenValid('delete'.$activiteHabitat->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($activiteHabitat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('activite_habitat_index');
    }
}
