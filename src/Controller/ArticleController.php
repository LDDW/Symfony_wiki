<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\NewArticleFormType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class ArticleController extends AbstractController
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * This function show articles in article pages
     *
     * @param $doctrine , $id
     * @return :Response
     */
    #[Route('/article/{id}', name: 'article_show', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function index(ManagerRegistry $doctrine, int $id): Response
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

    /**
     * This function delete article in article pages with current user
     *
     * @param $doctrine , $id
     * @return :Response
     */
    #[Route('/article/delete/{id}', name: 'article_delete', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function delete(ManagerRegistry $doctrine, int $id): Response
    {
        $user = $this->security->getUser();
        $article = $doctrine->getRepository(Article::class)->find($id);

        if (!$user) {
            throw $this->createAccessDeniedException(
                "Vous devez être connecté pour supprimer un article"
            );
        } else if (!$article) {
            throw $this->createNotFoundException(
                "Aucun produit n'a été trouvé pour l'id" . $id
            );
        } else if ($user != $article->getAuteur()) {
            throw $this->createAccessDeniedException(
                "Vous n'avez pas le droit de supprimer cet article"
            );
        }

        $entityManager = $doctrine->getManager();
        $entityManager->remove($article);
        $entityManager->flush();
        return $this->redirectToRoute('app_prive');
    }

    /**
     * This function create article in article pages with current user
     *
     * @param $doctrine , $id
     * @return :Response
     */
    #[Route('/article/new', name: 'app_new_article', methods: ['GET', 'POST'])]
    public function new(Request $request, ManagerRegistry $doctrine): Response
    {
        $user = $this->security->getUser(); // null or UserInterface, if logged in
        if (!$user) {
            throw $this->createAccessDeniedException(
                "Vous devez être connecté pour créer un article"
            );
        }

        $entityManager = $doctrine->getManager();

        $article = new Article();
        $article->setAuteur($user);
        $form = $this->createForm(NewArticleFormType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // save image
            $image = $form->get('image')->getData();
            $imageName = $image->getClientOriginalName();
            $imageName = md5(uniqid()) . '.' . pathinfo($imageName, PATHINFO_EXTENSION);
            $image->move(
                'assets/uploads',
                $imageName
            );
            $article->setImage('assets/uploads/' . $imageName);

            $article->setAuteur($user);
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('app_prive');
        }

        return $this->renderForm('new_article/index.html.twig', [
            'newArticleForm' => $form,
        ]);
    }

    /**
     * This function edit article in article pages with current user
     *
     * @param $doctrine , $id
     * @return :Response
     */
    #[Route('/article}/edit/{id}', name: 'article_edit', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function edit(Request $request, ManagerRegistry $doctrine, int $id): Response
    {
        $user = $this->security->getUser();
        $article = $doctrine->getRepository(Article::class)->find($id);

        if (!$user) {
            throw $this->createAccessDeniedException(
                "Vous devez être connecté pour créer un article"
            );
        } else if (!$article) {
            throw $this->createNotFoundException(
                "Aucun produit n'a été trouvé pour l'id" . $id
            );
        } else if ($user != $article->getAuteur()) {
            throw $this->createAccessDeniedException(
                "Vous n'avez pas le droit de modifier cet article"
            );
        }

        $entityManager = $doctrine->getManager();

        $form = $this->createForm(NewArticleFormType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // overwrite image
            $image = $form->get('image')->getData();
            $imageName = $article->getImage();
            $imageName = substr($imageName, strrpos($imageName, '/') + 1);
            $image->move(
                'assets/uploads',
                $imageName
            );
            $article->setImage('assets/uploads' . $image->getClientOriginalName());

            $entityManager->flush();

            return $this->redirectToRoute('app_prive');
        }

        return $this->renderForm('new_article/index.html.twig', [
            'newArticleForm' => $form,
        ]);
    }

}
