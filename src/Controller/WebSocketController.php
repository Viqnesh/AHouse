<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\WebSocketTestType;
use Symfony\Component\HttpFoundation\Request;

class WebSocketController extends AbstractController
{
    /**
     * @Route("/websocket", name="web_socket")
     */
    public function index(): Response
    {
        $form = $this->createForm(WebSocketTestType::class);
        $request = Request::createFromGlobals();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entryData = $form->getData();
            $context = new \ZMQContext();
            $socket = $context->getSocket(\ZMQ::SOCKET_PUSH, 'my pusher');
            $socket->connect("tcp://localhost:5555");
        
            $socket->send(json_encode($entryData));
        
        }
        // This is our new stuff

        return $this->render('web_socket/index.html.twig', [
            'controller_name' => 'WebSocketController',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/testwb", name="web_socket_test")
     */
    public function blankTest(): Response
    {
    
        return $this->render('web_socket/blankp.html.twig', [
            'controller_name' => 'WebSocketController',
        ]);
    }
}
