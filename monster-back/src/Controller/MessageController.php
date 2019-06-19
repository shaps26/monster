<?php

namespace App\Controller;

use App\Entity\Message;
use App\Form\MessageType;
use App\Repository\MessageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class MessageController extends AbstractController
{
    /**
     * @Route("/messages", name="messages")
     */
    public function index(MessageRepository $messageRepository, Request $request, EntityManagerInterface $entityManager)
    {
        $session = new Session();
        if (!$session->get('useridentifer'))
        {
            $session->set('useridentifer', uniqid());
        }
        $form = $this->createForm(MessageType::class, new Message());

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $message = $form->getData();
            $entityManager->persist($message);
            $entityManager->flush();
            $form = $this->createForm(MessageType::class, new Message());
        }


        $messages = $messageRepository->findAll();
        return $this->render('message/index.html.twig', [
            'messages' => $messages,
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/messages/new", name="post_message")
     */
    public function postMessage(Request $request, EntityManagerInterface $entityManager)
    {
        $body = $request->request->get('message');
        $expeditor = $request->request->get('expeditor');
        $message = new Message();
        $message->setBody($body);
        $message->setExpeditor($expeditor);
        $entityManager->persist($message);
        $entityManager->flush();
        return new Response();
    }
}
