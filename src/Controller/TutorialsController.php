<?php
/**
 * Created by PhpStorm.
 * User: fhasanli
 * Date: 12/5/2018
 * Time: 2:25 PM
 */

namespace App\Controller;

use App\Entity\Tutorials;
use App\Form\TutorialsType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TutorialsController extends Controller
{
    /**
     * @Route("/tutorials_new")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request)
    {
        $uploader = new Tutorials();

        $form = $this->createForm(TutorialsType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            /** @var UploadedFile $fileData */
            $fileData = $form->get('stage')->getData();
            $name = $form->get('name')->getData();

            $fileName = $this->randomName().".".$fileData->guessExtension();

            $fileData->move($this->getParameter('upload_path'),$fileName);
            $uploader->setStage($fileName);
            $uploader->setName($name);

            $entityManager->persist($uploader);
            $entityManager->flush();

            return new Response("Success upload");
        }

        return $this->render('tutorials/new.html.twig',[
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/tutorial_listing")
     * @return Response
     */
    public function listing()
    {
        $getRepo = $this->getDoctrine()->getRepository(Tutorials::class);

        $tutorials = $getRepo->findAll();

        return $this->render('tutorials/index.html.twig',[
            "tutorials" => $tutorials
        ]);
    }

    /**
     * @Route("/tutorial_remove/{id}", name="tutorial_remove")
     * @param Tutorials $tutorials
     * @param Request $request
     * @return Response
     */
    public function remove(Tutorials $tutorials, Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $token = $request->request->get('token');

        if($this->isCsrfTokenValid('tutorial_remove',$token))
        {
            $entityManager->remove($tutorials);
            $entityManager->flush();

            return new Response("Delete successfully!");
        }

        return new Response("Invalid token");
    }

    private function randomName()
    {
        return md5(uniqid());
    }
}