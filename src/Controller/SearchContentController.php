<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchContentController extends AbstractController
{
    /**
     * @Route("/search/content", name="search_content")
     */
    public function index(): Response
    {
        return $this->render('search_content/index.html.twig', [
            'controller_name' => 'SearchContentController',
        ]);
    }
}
