<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    #[Route('/article/{slug}', name: 'article_show')]
    public function show(?Article $article): Response
    {
        if (!$article) {
            return $this->redirectToRoute('app_accueil');
        }

        $commentForm = $this->createForm(CommentType::class, $comment);


        return $this->renderForm('article/show.html.twig', [
            'article' => $article,
            'commentForm' => $commentForm,
        ]);
    }
}
