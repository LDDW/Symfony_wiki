<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Article;
use App\Entity\User;
use Symfony\Component\Security\Core\Security;

class PriveController extends AbstractController
{
    private $security;

    public function __construct(Security $security)
    {
       $this->security = $security;
    }

    #[Route('/prive', name: 'app_prive')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $user = $this->security->getUser(); // null or UserInterface, if logged in

        // $articles = $doctrine->getRepository(Article::class)->findBy(array('auteur' => $user->getUserIdentifier()));
        $articles = $user->getArticle();
        // print_r($articles2 = $doctrine->getRepository(Article::class)->findBy(['auteur_id' => $user->getUserId()]));
        return $this->render('prive/index.html.twig', [
            'articles' => $articles,
        ]);
    }
}
