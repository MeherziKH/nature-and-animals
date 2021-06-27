<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
}
