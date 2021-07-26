<?php

namespace App\Controller;

use App\Entity\Consultation;
use App\Entity\Veterinaire;
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
        $con = $this->getDoctrine()->getRepository(Consultation::class)->findBy(['vet' => $id],
            ['date' => 'DESC']);
        //var_dump($con);
        $jsonContent = $serializer->serialize($con, 'json',['groups'=>'read']);
        return new Response($jsonContent);
        //return $this->render('consultation/vetcons.html.twig',array('consultations'=>$con));
    }
    /**
     * @Route("/vet/{id}", name="vet")
     */
    public function vet($id, SerializerInterface $serializer){
        $con = $this->getDoctrine()->getRepository(Veterinaire::class)->findBy(['id' => $id]);
        //var_dump($con);
        $jsonContent = $serializer->serialize($con, 'json');
        return new Response($jsonContent);
        //return $this->render('consultation/memcons.html.twig',array('consultations'=>$con));
    }
    /**
     * @Route("/consd/{d}/{id}", name="consd")
     */
    public function consd($d, $id, SerializerInterface $serializer){
        $date = new \DateTime($d);

        $con = $this->getDoctrine()->getRepository(Consultation::class)
            ->findBy(['date' => $date, 'vet' => $id]);
        //var_dump($con);
        $jsonContent = $serializer->serialize($con, 'json');
        return new Response($jsonContent);
        //return $this->render('consultation/memcons.html.twig',array('consultations'=>$con));
    }
    /**
     * @Route("/cons/{d}/{t}/{id}", name="cons")
     */
    public function cons($d, $t, $id, SerializerInterface $serializer){
        $date = new \DateTime($d);

        $con = $this->getDoctrine()->getRepository(Consultation::class)
            ->findBy(['date' => $date,'time' => $t, 'vet' => $id]);
        //var_dump($con);
        $jsonContent = $serializer->serialize($con, 'json');
        return new Response($jsonContent);
        //return $this->render('consultation/memcons.html.twig',array('consultations'=>$con));
    }
    /**
     * @Route("/consa/{id}", name="consa")
     */
    public function consAprouved($id, SerializerInterface $serializer){
        $date = new \DateTime();
        $con = $this->getDoctrine()->getRepository(Consultation::class)->findBy(['vet' => $id, 'approved'=>'1'],
            ['date' => 'DESC']);
        //var_dump($con);
        $jsonContent = $serializer->serialize($con, 'json',['groups'=>'read']);
        return new Response($jsonContent);
        //return $this->render('consultation/vetcons.html.twig',array('consultations'=>$con));
    }
    /**
     * @Route("/consna/{id}", name="consna")
     */
    public function consNonAprouved($id, SerializerInterface $serializer){
        $date = new \DateTime();
        $con = $this->getDoctrine()->getRepository(Consultation::class)->findBy(['vet' => $id, 'approved'=>''],
            ['date' => 'DESC']);
        //var_dump($con);
        $jsonContent = $serializer->serialize($con, 'json',['groups'=>'read']);
        return new Response($jsonContent);
        //return $this->render('consultation/vetcons.html.twig',array('consultations'=>$con));
    }
    /**
     * @Route("/today/{id}", name="today")
     */
    public function consToday($id, SerializerInterface $serializer){
        $date = new \DateTime();
        $con = $this->getDoctrine()->getRepository(Consultation::class)->findBy(['vet' => $id, 'date' =>$date],
            ['date' => 'DESC']);
        //var_dump($con);
        $jsonContent = $serializer->serialize($con, 'json',['groups'=>'read']);
        return new Response($jsonContent);
        //return $this->render('consultation/vetcons.html.twig',array('consultations'=>$con));
    }
}
