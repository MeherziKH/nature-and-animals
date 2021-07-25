<?php

namespace App\Controller;

use App\Entity\NoteVet;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class NoteVetController extends AbstractController
{
    /**
     * @Route("/note/vet", name="note_vet")
     */
    public function index(): Response
    {
        return $this->render('note_vet/index.html.twig', [
            'controller_name' => 'NoteVetController',
        ]);
    }
    /**
     * @Route("/api/note_vet", name="add", methods={"POST"})
     */
    public function addNote(Request $request, SerializerInterface $serialize)
    {
        $note = new NoteVet();

        $content = $request->getContent();
        $data    = $serialize->deserialize($content,NoteVet::class,'json');

        $note->setStatus($data->getStatus());
        $note->setDescription($data->getDescription());
        $note->setDate( $data->getDate());

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($note);
        $entityManager->flush();

        return new Response('okkk', 201);
    }
}
