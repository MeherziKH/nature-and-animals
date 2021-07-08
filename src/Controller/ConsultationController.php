<?php

namespace App\Controller;

use App\Entity\Consultation;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ConsultationController extends AbstractController
{
    /**
     * @Route("/consultation", name="consultation")
     */
    public function index(): Response
    {
        return $this->render('consultation/index.html.twig', [
            'controller_name' => 'ConsultationController',
        ]);
    }
    /**
     * @Route("/consm/{id}", name="consm")
     */
    public function consmem($id, SerializerInterface $serializer){
       $con = $this->getDoctrine()->getRepository(Consultation::class)->findBy(['membre' => $id]);
       //var_dump($con);
        $jsonContent = $serializer->serialize($con, 'json');
        return new Response($jsonContent);
       //return $this->render('consultation/memcons.html.twig',array('consultations'=>$con));
    }

    /**
     * @Route("/consv/{id}", name="consv")
     */
    public function consvet($id, SerializerInterface $serializer){
        $con = $this->getDoctrine()->getRepository(Consultation::class)->findBy(['vet' => $id]);
        //var_dump($con);
        $jsonContent = $serializer->serialize($con, 'json');
        return new Response($jsonContent);
        //return $this->render('consultation/vetcons.html.twig',array('consultations'=>$con));
    }
}
