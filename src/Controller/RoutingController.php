<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class RoutingController extends AbstractController
{
    /**
     * @Route({
     *     "en" : "/about",
     *     "az" : "/haqqimizda"
     *     }, name="about")
     * @return Response
     */
    public function about()
    {
        return new JsonResponse(['message' => 'Hello world!']);
    }

    /**
     * @Route("/blog/{page}", name="blog_listing", requirements={"page"="\d+"})
     */
    public function listing($page)
    {
        return new Response('Current page is '.$page);
    }

    /**
     * @Route("/blog-listing/{page<\d+>}", name="blog_listing_short")
     */
    public function listingShort($page)
    {
        return new Response('Current page is '.$page);
    }

    /**
     * @Route("/blog/{slug}", name="blog_listing_slug")
     */
    public function listingWithSlug($slug)
    {
        return new Response('Post slug is '.$slug);
    }

    /**
     * @Route("/routing/Hello/{_locale}", defaults={"_locale"="az"}, requirements={
     *     "_locale"="en|az"
     *     })
     */
    public function helloRouting($_locale)
    {
        return new Response('Locale is '.$_locale);
    }

    /**
     * @Route("/api/posts/{id}", methods={"GET","HEAD"})
     */
    public function showPost($id)
    {
        return new JsonResponse(["message" => $id]);
    }

    /**
     * @Route("/api/posts2/{id<\d+>?2}")
     */
    public function showPost2($id)
    {
        return new JsonResponse(["message" => $id]);
    }

    /**
     * @Route("/articles/{_locale}/{year}/{slug}.{_format}", name="show-post-2",
     *          defaults={"_format": "html"},
     *          requirements={
     *              "_locale": "az|ru",
     *              "_format": "html|json",
     *              "year": "\d+"
     *     }
     *  )
     * @return JsonResponse
     */
    public function showArticles($_locale,$year,$slug,$_format)
    {
        return new JsonResponse(["message" => implode("---",[
            $_locale,$year,$slug,$_format,
        ])]);
    }

    /**
     * @Route("/urlgenerator")
     */
    public function urlGenerator()
    {
        $generateUrl = $this->generateUrl('show-post-2',[
            '_locale'   => 'ru',
            '_format'   => 'json',
            'year'      => 1992,
            'slug'      => 'Birthday'
        ]);

        return new JsonResponse(["message" => $generateUrl]);
    }

    /**
     * @Route("/urlgenerator2")
     */
    public function urlGenerator2(UrlGeneratorInterface $route)
    {
        $generateUrl = $route->generate('show-post-2',[
            '_locale'   => 'ru',
            '_format'   => 'json',
            'year'      => 1992,
            'slug'      => 'my-birthday'
        ]);

        return new JsonResponse(["message" => $generateUrl]);
    }

    /**
     * @Route("/urlgenerator3")
     */
    public function urlGeneratorNew()
    {
        $generateUrl = $this->generateUrl('blog_listing_short',[
            'page' => 20,
            'category' => 'Sport'
        ]);

        $generateUrlFull = $this->generateUrl('blog_listing_short',[
            'page' => 20,
            'category' => 'Sport'
        ], UrlGeneratorInterface::ABSOLUTE_URL);

        return new JsonResponse(["message" => $generateUrl, "fullUrl" => $generateUrlFull]);
    }

    /**
     * @Route("/urltwig")
     * @return Response
     */
    public function urlOnTwig()
    {
        return $this->render('routing/index.html.twig');
    }
}
