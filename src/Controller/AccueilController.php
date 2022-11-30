<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $cat1 = random_int(1, 4);
        $cat2 = random_int(1, 4);

        $article1 = $doctrine->getRepository(Articles::class)->find($cat1);
        $article2 = $doctrine->getRepository(Articles::class)->find($cat2);
        return $this->render('accueil/index.html.twig', [
            'article1' => $article1,
            'article2' => $article2
        ]);
    }
}
