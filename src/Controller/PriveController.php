<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class PriveController extends AbstractController
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @Route("/prive", name="prive")
     *
     * @param ManagerRegistry $doctrine
     * @return Response
     */
    #[Route('/prive', name: 'app_prive')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $user = $this->security->getUser();
        $articles = $user->getArticle();

        return $this->render('prive/index.html.twig', [
            'articles' => $articles,
        ]);
    }
}
