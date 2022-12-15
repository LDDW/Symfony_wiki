<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\User;
use App\Entity\Categorie;
use App\Form\NewArticleFormType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;


class NewArticleController extends AbstractController
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    #[Route('/new/article', name: 'app_new_article')]
    public function index(Request $request, ManagerRegistry $doctrine): Response
    {
        $user = $this->security->getUser(); // null or UserInterface, if logged in

        $entityManager = $doctrine->getManager();

        $article = new Article();
        $form = $this->createForm(NewArticleFormType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $article->setAuteur($user);
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('app_prive');
        }

        return $this->renderForm('new_article/index.html.twig', [
            'newArticleForm' => $form,
        ]);
    }
}
