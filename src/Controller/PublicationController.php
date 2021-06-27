<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use App\Entity\Publication;

class PublicationController extends AbstractController
{

    /**
     * @Route("/api/publications", name="add", methods={"POST"})
     */
    public function addPublication(Request $request, SerializerInterface $serialize)
    {
            $publication = new Publication();

            $content = $request->getContent();
            $data    = $serialize->deserialize($content,Publication::class,'json');

            $publication->setStatus($data->getStatus());
            $publication->setDescription($data->getDescription());
            $publication->setDate( $data->getDate());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($publication);
            $entityManager->flush();

            return new Response('okkk', 201);
    }
}
