<?php
/**
 * Created by PhpStorm.
 * User: fhasanli
 * Date: 12/4/2018
 * Time: 10:25 AM
 */

namespace App\Controller;

use App\Entity\Validate;
use App\Form\ValidateType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateController extends Controller
{
    /**
     * @Route("/validate_type")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request)
    {
        $validate = new Validate();

        $form = $this->createForm(ValidateType::class,$validate);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            return new Response("Success validation");
        }

        if($form->isSubmitted())
        {
            $errors = $form->getErrors(true);

            foreach ($errors as $error)
            {
                echo $error->getMessage()."<hr />";
            }
            exit;
        }

        return $this->render("validate/new.html.twig", [
            "form" => $form->createView()
        ]);
    }
}