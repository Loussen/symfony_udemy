<?php
/**
 * Created by PhpStorm.
 * User: fhasanli
 * Date: 11/30/2018
 * Time: 3:00 PM
 */

namespace App\Controller;

use App\Entity\Products;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/products", name="products_index")
     */
    public function index()
    {
        $productRepository = $this->getDoctrine()->getRepository(Products::class);

        $products = $productRepository->findAll();

        return $this->render('products/index.html.twig',[
            "products" => $products
        ]);
    }

    /**
     * @Route("/products/create", name="products_create")
     * @return Response
     */
    public function create()
    {
        $entityManager = $this->getDoctrine()->getManager();

        $product = new Products();

        $product
            ->setName('Fuad')
            ->setDescription('Product')
            ->setPrice(500)
            ;

        $entityManager->persist($product);

        $entityManager->flush();

        return new Response("Product have been created! Product id: ".$product->getId());
    }

    /**
     * @Route("/products/show/{id}", name="products_show")
     * @param Products $products
     * @return Response
     */
    public function show(Products $products)
    {
        return new Response("Product id: ".$products->getId()." ".$products->getName());
    }

    /**
     * @Route("/products/show2/{id}", name="products_show2")
     * @param $id
     * @return Response
     */
    public function show2($id)
    {
        $productRepository = $this->getDoctrine()->getRepository(Products::class);

        $product = $productRepository->find($id);

        return new Response("Product id is ".$product->getId());
    }

    /**
     * @Route("/products/update/{id}", name="products_update")
     * @param $id
     * @param Request $request
     * @return Response
     */
    public function update($id, Request $request)
    {
        $name = $request->get('name');

        $entityManager = $this->getDoctrine()->getManager();
        $productRepository = $entityManager->getRepository(Products::class);

        $product = $productRepository->find($id);

        $product
            ->setName($name)
            ->setPrice(rand(10,1000))
        ;

        $entityManager->persist($product);
        $entityManager->flush();

        return new Response("Updated product id is ".$product->getId());
    }

    /**
     * @Route("/products/delete/{id}", name="products_delete")
     * @param $id
     * @return Response|\Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function delete($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $product = $entityManager->getRepository(Products::class)->find($id);

        if(!$product)
        {
            return $this->createNotFoundException('Not found');
        }

        $entityManager->remove($product);
        $entityManager->flush();

        return new Response("Product deleted");
    }

    /**
     * @Route("/products/showparam/{id}", name="products_show_param")
     * @param Products $products
     * @return Response
     * @ParamConverter("products", options={"mapping" : {"id" = "name"}})
     */
    public function showParam(Products $products)
    {
        return new Response("Product id: ".$products->getId()." ".$products->getName());
    }
}