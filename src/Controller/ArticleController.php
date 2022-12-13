<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Article;

class ArticleController extends AbstractController
{
    #[Route('/article/{id}', name: 'article_show')]
    public function index(ManagerRegistry $doctrine,int $id): Response
    {
        $article = $doctrine->getRepository(Article::class)->find($id);
        if (!$article) {
            throw $this->createNotFoundException(
                "Aucun produit n'a été trouvé pour l'id" . $id
            );
        }
        return $this->render('article/index.html.twig', [
            'article' => $article,
        ]);
    }
}
