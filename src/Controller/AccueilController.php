<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Article;
use App\Entity\Categorie;

class AccueilController extends AbstractController
{   
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
    private function getRandom(Array $data){
        $array = $data;
        shuffle($array);
        $array = array_slice($array, 0, 2);
        return $array;
    } 
}
