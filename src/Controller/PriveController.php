<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class PriveController extends AbstractController
{
    /**
     * @var Object
     */
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * This function show list of articles create by user logged
     * 
     * @return Response
     */
    #[Route('/prive', name: 'app_prive')]
    public function index(): Response
    {
        $user = $this->security->getUser();
        $articles = $user->getArticle();

        return $this->render('prive/index.html.twig', [
            'articles' => $articles,
        ]);
    }
}
