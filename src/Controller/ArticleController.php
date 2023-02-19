<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Comment;
use src\Form\Type\CommentType;
use App\Service\CommentService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    #[Route('/article/{slug}', name: 'article_show')]
    public function show(?Article $article, CommentService $commentService): Response
    {
        if (!$article) {
            return $this->redirectToRoute('app_accueil');
        }
         
        $comment = new Comment($article);
        
        $commentForm = $this->createForm(CommentType::class, $comment);


        return $this->renderForm('article/show.html.twig', [
            'article' => $article,
            'commentForm' => $commentForm,
            'comments' =>$commentService->getPaginatedComments($article),
        ]);
    }
}
