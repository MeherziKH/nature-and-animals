<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/api/productsList/{id}", name="productsList", methods={"GET"})
     */
    public function productsList($id): Response
    {
        $product = $this->getDoctrine()->getRepository(Product::class)->getByCategory($id);
    }
}
