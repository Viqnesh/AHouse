<?php

namespace App\Controller;

use App\Entity\TypeHabitat;
use App\Form\TypeHabitat1Type;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("gerant/type/habitat")
 */
class TypeHabitatController extends AbstractController
{
    /**
     * @Route("/", name="type_habitat_index", methods={"GET"})
     */
    public function index(): Response
    {
        $typeHabitats = $this->getDoctrine()
            ->getRepository(TypeHabitat::class)
            ->findAll();

        return $this->render('type_habitat/index.html.twig', [
            'type_habitats' => $typeHabitats,
        ]);
    }

    /**
     * @Route("/new", name="type_habitat_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $typeHabitat = new TypeHabitat();
        $form = $this->createForm(TypeHabitat1Type::class, $typeHabitat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($typeHabitat);
            $entityManager->flush();

            return $this->redirectToRoute('type_habitat_index');
        }

        return $this->render('type_habitat/new.html.twig', [
            'type_habitat' => $typeHabitat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_habitat_show", methods={"GET"})
     */
    public function show(TypeHabitat $typeHabitat): Response
    {
        return $this->render('type_habitat/show.html.twig', [
            'type_habitat' => $typeHabitat,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="type_habitat_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TypeHabitat $typeHabitat): Response
    {
        $form = $this->createForm(TypeHabitat1Type::class, $typeHabitat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('type_habitat_index');
        }

        return $this->render('type_habitat/edit.html.twig', [
            'type_habitat' => $typeHabitat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_habitat_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TypeHabitat $typeHabitat): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeHabitat->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($typeHabitat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('type_habitat_index');
    }
}
