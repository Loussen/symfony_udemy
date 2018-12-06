<?php
/**
 * Created by PhpStorm.
 * User: fhasanli
 * Date: 12/6/2018
 * Time: 1:31 PM
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{
    /**
     * @Route("/login_form", name="login_form")
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function login_form(AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/index.html.twig',[
            'lastUsername' => $lastUsername,
            'error' => $error
        ]);
    }
}