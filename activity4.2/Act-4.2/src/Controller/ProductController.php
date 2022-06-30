<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Produit;


class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="app_product")
     */
    public function index(): Response
    {
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }
 
  /**
     * @Route("/create-product/{label}/{price}/{quantity}", name="product.create", methods={"GET","HEAD"},requirements={"id"="\d+"})
     */
    public function createProduct(ManagerRegistry $doctrine, string $label, int $price, int $quantity): Response
    {
        $entityManager = $doctrine->getManager();

        $product = new Produit();
        $product->setLabel($label)
        ->setPrice($price)
        ->setQuantity($quantity);

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new product with id '.$product->getId());
      
    }

    /**
     * @Route("/edit-product/{id}/{label}/{price}/{quantity}")
     *  
     */
    public function update(ManagerRegistry $doctrine,  int $id, string $label, int $price, int $quantity): Response
    {
        $entityManager = $doctrine->getManager();
        $product = $entityManager->getRepository(Produit::class)->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $product->setLabel($label)
        ->setPrice($price)
        ->setQuantity($quantity);

        $entityManager->flush();

        return new Response('Saved new product with id '.$product->getId());
    }

/**
     * @Route("/get-all-products", name="get-all-products")
     */
    public function getproduct(): Response
    {
        $repo=$this->getDoctrine()->getRepository(produit::class);
        $products=$repo->findAll();
        return $this->render('product/index.html.twig', [
            'controller_name' => 'productController',
            'products' =>$products
        ]);
      
    }
      /**
     * @Route("/product/{id}", name="product.detail")
     */
    public function productDetails(Produit $product): Response
    {
        return $this->render('product/detail.html.twig', [
            'product' => $product,
        ]);
    }
    
}
