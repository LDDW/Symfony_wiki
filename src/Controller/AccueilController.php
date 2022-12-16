<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Categorie;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    /**
     * This function return 'accueil' page with 2 random articles and categories
     * 
     * @param ManagerRegistry $doctrine
     * @return Response
     */
    #[Route('/', name: 'app_accueil')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $categories = $doctrine->getRepository(Categorie::class)->findAll();
        $articles = $doctrine->getRepository(Article::class)->findAll();

        return $this->render('accueil/index.html.twig', [
            'articles' => $this->getRandom($articles),
            'categories' => $this->getRandom($categories),
        ]);
    }

    /**
     * This function permit to return 2 random index in array param
     *
     * @param array $data
     * @return array
     */
    private function getRandom(array $data)
    {
        $array = $data;
        shuffle($array);
        $array = array_slice($array, 0, 2);
        return $array;
    }
}
