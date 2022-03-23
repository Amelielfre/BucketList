<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    
    /**
     * @Route("/", name="app_main")
     */
    public function index(): Response
    {
        return $this->render('main/home.html.twig');
    }

    /**
     * @Route("/about-us", name="app_aboutUs")
     */
    public function aboutUs(): Response
    {
        return $this->render('main/about-us.html.twig');
    }

    /**
     * @Route("/legal-stuff",name="app_legalStuff")
     */
    public function legalStuff(): Response
    {
        return $this->render('main/legal-stuff.html.twig');
    }

}
