<?php

namespace App\Controller;

use App\Entity\Consultation;
use phpDocumentor\Reflection\Types\Integer;
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
     * @Route("/consmem/{id}", name="consmem")
     */
    /*public function consmem($id){
       $con = $this->getDoctrine()->getRepository(Consultation::class)->findBy(array('membre' => $id));
       return $this->render()
    }*/

}
