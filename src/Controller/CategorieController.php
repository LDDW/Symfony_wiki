<?php

namespace App\Controller;

use App\Entity\Articles;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategorieController extends AbstractController
{
    #[Route('/categorie/{id_categorie}', name: 'show_categorie')]
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
