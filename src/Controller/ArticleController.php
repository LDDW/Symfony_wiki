<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Articles;

class ArticleController extends AbstractController
{
    /**
     * This function show articles in article pages
     * 
     * @param $doctrine, $id
     * @return :Response
     */
    #[Route('/article/{id}', name: 'article_show')]
    public function index(ManagerRegistry $doctrine,int $id): Response
    {
        $article = $doctrine->getRepository(Articles::class)->find($id);
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
