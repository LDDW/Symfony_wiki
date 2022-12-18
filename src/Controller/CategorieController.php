<?php

namespace App\Controller;

use App\Entity\Categorie;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class CategorieController extends AbstractController
{
    /**
     * This function show list of categories
     * 
     * @param ManagerRegistry $doctrine
     * @param int $id
     * @return Response
     */
    #[Route('/categorie/liste/', name: 'app_listeCategorie', priority: 1)]
    public function index(ManagerRegistry $doctrine): Response
    {
        $categories = $doctrine->getRepository(Categorie::class)->findAll();

        return $this->render('listeCategorie/index.html.twig', [
            'categories' => $categories
        ]);
    }

    /**
     * This function show the articles of a category
     * 
     * @param ManagerRegistry $doctrine
     * @param int $id
     * @return Response
     */
    #[Route('/categorie/{id_categorie}', name: 'show_categorie', priority: 2, requirements: ['id_categorie' => '\d+'])]
    public function show_categorie(ManagerRegistry $doctrine, int $id_categorie): Response
    {
        $articles = $doctrine->getRepository(Categorie::class)->find($id_categorie)->getArticle();
        // $nombre = count($articles);

        return $this->render('categorie/index.html.twig', [
            'articles' => $articles
        ]);
    }
}
