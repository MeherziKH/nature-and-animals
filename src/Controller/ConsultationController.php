<?php

namespace App\Controller;

use App\Entity\Consultation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
     * @Route("/listcons", name="listcons")
     */
    public function listcons()
    {
        $cons=$this->getDoctrine()->getRepository(Consultation::class)->findAll();
        return $this->render("consultation/listCons.html.twig",array("listCons"=>$cons));
    }
}
