<?php
/**
 * Created by PhpStorm.
 * User: fhasanli
 * Date: 12/4/2018
 * Time: 10:25 AM
 */

namespace App\Controller;

use App\Entity\Todos;
use App\Form\TodosType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TodosController extends Controller
{
    /**
     * @Route("/new_todo", name="new_todo")
     * @return Response
     */
    public function new(Request $request)
    {
        $todo = new Todos();

        $form = $this->createForm(TodosType::class,$todo);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            /** @var Todos $todo */
            $todo = $form->getData();

            $data = $request->request->all();
            var_dump($data); exit;

            $entityManager->persist($todo);
            $entityManager->flush();

            return $this->redirectToRoute("listing");
        }

        return $this->render("todos/new.html.twig", [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/todos", name="listing")
     * @return Response
     */
    public function list()
    {
        $getRepo = $this->getDoctrine()->getRepository(Todos::class);

        $todos = $getRepo->findAll();

        return $this->render("todos/list.html.twig", [
            "todos" => $todos
        ]);
    }
}