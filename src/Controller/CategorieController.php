<?php

namespace App\Controller;

use App\Entity\Articles;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Categorie;



class CategorieController extends AbstractController
{
    #[Route('/categorie/liste/', name: 'app_listeCategorie', priority: 1)]
    public function index(ManagerRegistry $doctrine): Response
    {
        $categories = $doctrine->getRepository(Categorie::class)->findAll();
        foreach ($categories as $categorie) {
            $categorie->articles = $doctrine->getRepository(Articles::class)->findBy(['categorie' => $categorie->getId()]);
        }
        $nombre = count($categories);
        return $this->render('listeCategorie/index.html.twig', [
            'categories' => $categories,
            'nombre' => $nombre
            
        ]);
    }

    #[Route('/categorie/{id_categorie}', name: 'show_categorie' , priority: 2, requirements: ['id_categorie' => '\d+'])]
    public function show_categorie(ManagerRegistry $doctrine,  int $id_categorie): Response
    {
        $articles = $doctrine->getRepository(Articles::class)->findBy(['categorie' => $id_categorie]);
        $nombre = count($articles);

        return $this->render('categorie/index.html.twig', [
            'articles' => $articles,
            'nombre' => $nombre
        ]);
    }
}
