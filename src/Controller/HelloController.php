<?php
/**
 * Created by PhpStorm.
 * User: fhasanli
 * Date: 11/25/2018
 * Time: 7:25 PM
 */

namespace App\Controller;

use App\Service\MessageGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends Controller
{
    /**
     * @Route("/Hello")
     * @param MessageGenerator $messageGenerator
     * @return Response
     */
    public function hello()
    {
        $messageGenerator = $this->container->get('message');
        $session = $this->container->get('session');
        return new Response($messageGenerator->helloMessage()." - ".$session->getName());
    }
}