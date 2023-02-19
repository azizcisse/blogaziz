<?php

namespace App\Controller;

use App\Entity\Category;
use App\Service\ArticleService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    #[Route('/category/{slug}', name: 'category_show')]
    public function show(?Category $category = null, ArticleService $articleService): Response
    {
        if (!$category) {
            return $this->redirectToRoute('app_accueil');
        }
        return $this->render('category/show.html.twig', [
            'category' => $category,
            'articles' =>$articleService->getPaginatedArticles($category),
        ]);
    }
}
