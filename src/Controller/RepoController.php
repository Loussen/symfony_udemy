<?php
/**
 * Created by PhpStorm.
 * User: fhasanli
 * Date: 12/2/2018
 * Time: 12:32 AM
 */

namespace App\Controller;

use App\Entity\Products;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RepoController extends AbstractController
{
    /**
     * @Route("/repo/testquery/{price}")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index($price)
    {
        $getRepo = $this->getDoctrine()->getRepository(Products::class);

        $products = $getRepo->getGreateThan($price);

        return $this->render("products/index.html.twig",[
            "products" => $products
        ]);
    }

    /**
     * @Route("/repo/simple_sql")
     */
    public function simpleSql()
    {
        $entityManager = $this->getDoctrine()->getManager();

        $sql = "SELECT * FROM `products` WHERE `price` > :price ORDER BY`price` ASC ";

        $statement = $entityManager->getConnection()->prepare($sql);
        $statement->bindValue('price',55);
        $statement->execute();

        $result = $statement->fetchAll();

        var_dump($result); exit;
    }
}