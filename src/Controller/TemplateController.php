<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TemplateController extends AbstractController
{
    /**
     * @Route("/template", name="template")
     */
    public function index()
    {
        return $this->render('template/index.html.twig');
    }

    /**
     * @Route("/template-tags")
     */
    public function twig_tags()
    {
        return $this->render('template/twig_tags.html.twig',[
            'countries' => [
                'Baku',
                'Sumgait',
                'Ganja'
            ],
            'string' => 'My name is Fuad'
        ]);
    }
}
