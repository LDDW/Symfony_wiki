<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListeCategorieController extends AbstractController
{
    #[Route('/categorie/liste/', name: 'app_listeCategorie')]
    public function index(): Response
    {
        return $this->render('listeCategorie/index.html.twig', [
            'controller_name' => 'ListeCategorieController',
        ]);
    }
}
