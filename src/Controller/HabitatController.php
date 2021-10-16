<?php

namespace App\Controller;

use App\Entity\Habitat;
use App\Form\HabitatType;
use App\Entity\User;
use App\Repository\HabitatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 */
/**
 * @Route("/habitat")
 * @IsGranted("ROLE_USER") 
 */
class HabitatController extends AbstractController
{
    /**
     * @Route("/", name="habitat_index", methods={"GET"})
     */
    public function index(): Response
    {
        $user = $this->getUser();
        $habitats = $this->getDoctrine()
            ->getRepository(Habitat::class)
            ->findBy(['proprietaire' => $user]);

        return $this->render('habitat/index.html.twig', [
            'habitats' => $habitats,
        ]);
    }

    /**
     * @Route("/new", name="habitat_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $habitat = new Habitat();
        $user = $this->getUser();
        $habitat->setProprietaire($user);
        $form = $this->createForm(HabitatType::class, $habitat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($habitat);
            $entityManager->flush();

            return $this->redirectToRoute('habitat_index');
        }

        return $this->render('habitat/new.html.twig', [
            'habitat' => $habitat,
            'form' => $form->createView(),

        ]);
    }

    /**
     * @Route("/{id}", name="habitat_show", methods={"GET"})
     */
    public function show(Habitat $habitat): Response
    {
        return $this->render('habitat/show.html.twig', [
            'habitat' => $habitat,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="habitat_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Habitat $habitat): Response
    {
        $form = $this->createForm(HabitatType::class, $habitat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('habitat_index');
        }

        return $this->render('habitat/edit.html.twig', [
            'habitat' => $habitat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="habitat_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Habitat $habitat): Response
    {
        if ($this->isCsrfTokenValid('delete'.$habitat->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($habitat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('habitat_index');
    }
}
