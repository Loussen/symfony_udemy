<?php
/**
 * Created by PhpStorm.
 * User: fhasanli
 * Date: 12/6/2018
 * Time: 12:32 PM
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends Controller
{
    /**
     * @Route("/admin")
     * @return Response
     */
    public function admin()
    {
        return new Response("<html><body>Admin page</body></html>");
    }
}