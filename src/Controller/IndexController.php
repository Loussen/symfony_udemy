<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @return Response
     */
    public function index()
    {
//        return new Response('Hello world!');
//        return new JsonResponse(['message' => 'Hello world!']);

        return $this->render('index/index.html.twig',[
            'controller_name' => 'IndexController'
        ]);
    }

    /**
     * @Route("/request", name="request_test")
     * @param RequestStack $requestStack
     */
    public function requesttest(RequestStack $requestStack)
    {
        $request = $requestStack->getCurrentRequest();

        // $_POST
        $request->request->get('name');

        // $_GET
        $request->query->get('name');

        // $_COOKIE
        $request->cookies->get('name');

        // Not common
        $request->attributes->get('name');

        // $_FILES
        $request->files->get('name');

        // $_SERVER
        $request->server->get('REMOTE_ADDR');

        $header = $request->headers->all();
        var_dump($header); exit;
    }

    /**
     * @Route("/response", name="response_test")
     * @param RequestStack $requestStack
     * @return Response
     */
    public function responsetest(RequestStack $requestStack)
    {
        return $this->redirectToRoute('request_test');
//        return new Response('Hello world');
    }

    /**
     * @Route("/service", name="service_test")
     * @param SessionInterface $session
     * @return Response
     */
    public function service(SessionInterface $session)
    {
        $session = $this->container->get('session');

        return new Response($session->getName());
    }
}
