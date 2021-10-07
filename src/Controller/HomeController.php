<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function afficherHome(): Response
    {
        $reponse = $this->render('home.html.twig');

        return $reponse;
    }

    /**
     * @Route("/cgu", name="cgu")
     */
    public function afficherCgu(): Response
    {
        $reponse = $this->render('cgu.html.twig');

        return $reponse;
    }
}
