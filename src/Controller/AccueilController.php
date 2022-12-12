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
        $categorie1 = $doctrine->getRepository(Categorie::class)->findBy(['id' => 1]);
        $categorie2 = $doctrine->getRepository(Categorie::class)->findBy(['id' => 2]);
        $article1 = $doctrine->getRepository(Articles::class)->findBy(['categorie' => 1]);
        $article2 = $doctrine->getRepository(Articles::class)->findBy(['categorie' => 2]);
        return $this->render('accueil/index.html.twig', [
            'article1' => $article1[random_int(0, 3)],
            'article2' => $article2[random_int(0, 3)],
            'categories' => $categories,
            'categorie1' => $categorie1[random_int(0, 3)],
            'categorie2' => $categorie2[random_int(0, 3)],
        ]);
    }
}
