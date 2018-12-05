<?php
/**
 * Created by PhpStorm.
 * User: fhasanli
 * Date: 12/4/2018
 * Time: 10:25 AM
 */

namespace App\Controller;

use App\Form\TypesType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class TypesController extends Controller
{
    /**
     * @Route("/types")
     * @return Response
     */
    public function new()
    {
        $form = $this->createForm(TypesType::class);

        return $this->render("types/new.html.twig", [
            "form" => $form->createView()
        ]);
    }
}