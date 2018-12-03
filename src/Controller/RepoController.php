<?php
/**
 * Created by PhpStorm.
 * User: fhasanli
 * Date: 12/2/2018
 * Time: 12:32 AM
 */

namespace App\Controller;

use App\Entity\Categories;
use App\Entity\Groups;
use App\Entity\Products;
use App\Entity\Users;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

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

    /**
     * @Route("/many-to-one-insert")
     */
    public function manyToOneInsert()
    {
        $entityManager = $this->getDoctrine()->getManager();

        $category = new Categories();
        $category->setName('Sport');

        $product = new Products();
        $product->setName('Nike');
        $product->setPrice(150);
        $product->setCategory($category);

        $entityManager->persist($category);
        $entityManager->persist($product);

        $entityManager->flush();

        return new Response(sprintf("Product ID - %s -> Category ID - %s",$product->getId(),$category->getId()));
    }

    /**
     * @Route("/many-to-one-select/{id}")
     * @param Products $products
     * @return Response
     */
    public function manyToOneSelect(Products $products)
    {
        $category = $products->getCategory();

        return new Response(sprintf("Product ID : %s -> Category name : %s",$products->getId(),$category->getName()));
    }

    /**
     * @Route("one-to-many-select/{id}")
     * @param Categories $categories
     * @return Response
     */
    public function oneToManySelect(Categories $categories)
    {
        $products = $categories->getProducts();

        foreach ($products as $product)
        {
            echo $product->getName()."<br />";
        }

        return new Response("");
    }

    /**
     * @Route("/one-to-many-select-query/{id}")
     * @param Categories $categories
     * @return Response
     */
    public function oneToManySelectQuery(Categories $categories)
    {
        $getRepo = $this->getDoctrine()->getRepository(Products::class);

        $products = $getRepo->getByCategory($categories);

        foreach ($products as $product)
        {
            echo $product->getName()."<br />";
        }

        return new Response("");
    }

    /**
     * @Route("/many-to-many-insert")
     * @return Response
     */
    public function manyToManyInsert()
    {
        $entityManager = $this->getDoctrine()->getManager();

        $user1 = new Users();
        $user1->setName("Fuad");
        $user1->setUsername("Loussen");

        $user2 = new Users();
        $user2->setName("Yusif");
        $user2->setUsername("Nasibli");

        $user3 = new Users();
        $user3->setName("Elnur");
        $user3->setUsername("Alizade");

        $group1 = new Groups();
        $group1->setName("Admin");

        $group2 = new Groups();
        $group2->setName("Editor");

        $group1->addUser($user1);
        $group1->addUser($user2);
        $group2->addUser($user2);
        $group2->addUser($user3);

        $entityManager->persist($user1);
        $entityManager->persist($user2);
        $entityManager->persist($user3);
        $entityManager->persist($group1);
        $entityManager->persist($group2);

        $entityManager->flush();

        return new Response("");

    }
}