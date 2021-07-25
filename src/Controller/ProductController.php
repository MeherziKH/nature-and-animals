<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\{Response, JsonResponse};
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/bestSeller", name="bestSeller")
     */
    public function bestSeller(): Response
    {
        $productRepo = $this->em->getRepository(Product::class);
        $products = $productRepo->bestSeller();
        return new JsonResponse($products, Response::HTTP_OK);
    }
}
