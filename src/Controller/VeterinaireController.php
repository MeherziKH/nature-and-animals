<?php

namespace App\Controller;

use App\Entity\Veterinaire;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VeterinaireController extends AbstractController
{
    /**
     * @Route("/veterinaire", name="veterinaire")
     */
    public function index(): Response
    {
        return $this->render('veterinaire/index.html.twig', [
            'controller_name' => 'VeterinaireController',
        ]);
    }
    /**
     * @Route("/listVet", name="listVet")
     */
    public function listVet(){
        $vets=$this->getDoctrine()->getRepository(Veterinaire::class)->findAll();
        return $this->render("veterinaire/listVeterinaires.html.twig",array('listVeterinaires'=>$vets));
    }

}
