<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Articles;
use App\Entity\Categorie;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $categories = $doctrine->getRepository(Categorie::class)->findAll();
        $article1 = $doctrine->getRepository(Articles::class)->findBy(['categorie' => 1]);
        $article2 = $doctrine->getRepository(Articles::class)->findBy(['categorie' => 2]);
        return $this->render('accueil/index.html.twig', [
            'article1' => $article1[random_int(0, count($article1) - 1)],
            'article2' => $article2[random_int(0, count($article2) - 1)],
            'categorie1' => $categories[random_int(0, count($categories) - 1)],
            'categorie2' => $categories[random_int(0, count($categories) - 1)],
        ]);
    }
}
