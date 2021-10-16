<?php

namespace App\Controller;

use App\Entity\PriseDeVue;
use App\Form\PriseDeVueType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\PriseDeVueRepository;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/prisedevue")
 */
class PriseDeVueController extends AbstractController
{

        /**
     * @Route("/", name="prisedevue_index", methods={"GET"})
     */
    public function index(PriseDeVueRepository $PriseDeVueRepository): Response
    {
        return $this->render('prise_de_vue/index.html.twig', [
            'prise_de_vues' => $PriseDeVueRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="prisedevue_show", methods={"GET"})
     */
    public function show(PrisedeVue $prisedevue): Response
    {
        return $this->render('prise_de_vue/show.html.twig', [
            'prise_de_vue' => $prisedevue,
        ]);
    }
    /**
     * @Route("/newPhoto/{idHabitat}", name="prisedevue_new", methods={"GET","POST"})
     */
    public function new(Request $request, Habitat $habitat): Response
    {
        $priseDeVue = new PriseDeVue();
        $form = $this->createForm(PriseDeVueType::class, $priseDeVue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($priseDeVue);
            $entityManager->flush();

            return $this->redirectToRoute('prise_de_vue_index');
        }

        return $this->render('prise_de_vue/new.html.twig', [
            'prise_de_vue' => $priseDeVue,
            'form' => $form->createView(),
        ]);
    }

}
