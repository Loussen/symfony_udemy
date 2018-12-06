<?php
/**
 * Created by PhpStorm.
 * User: fhasanli
 * Date: 12/6/2018
 * Time: 10:15 AM
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\TranslatorInterface;

class TranslatorController extends Controller
{
    /**
     * @Route("/translator")
     * @param TranslatorInterface $translator
     * @return Response
     */
    public function translator(TranslatorInterface $translator)
    {
        $message = $translator->trans('hello.user');

        $message2 = $translator->trans('Hello %user%',[
            '%user%' => "Fuad"
        ]);

        $count = 1000;
        $message3 = $translator->transChoice(
            '{0} nothing | ]1,29] %count% count | [30,Inf[ none limit',
            $count,
            [
                '%count%' => $count
            ]
        );

        return $this->render('translator/index.html.twig', [
            'message' => $message,
            'message2' => $message2,
            'message3' => $message3
        ]);
    }
}