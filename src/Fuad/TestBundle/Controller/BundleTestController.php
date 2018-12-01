<?php

namespace App\Fuad\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BundleTestController extends Controller
{
    /**
     * @Route("/bundle-test/hello")
     * @return Response
     */
    public function hello()
    {
        return $this->render('@FuadTest/Hello/index.html.twig');
    }
}