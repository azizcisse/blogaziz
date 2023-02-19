<?php

namespace App\Controller;

use App\Service\ArticleService;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function index(ArticleService $articleService, CategoryRepository $categoryRepo): Response
    {
        return $this->render('accueil/index.html.twig',[
         'articles' =>$articleService->getPaginatedArticles(),
         'categories' =>$categoryRepo->findAll(),            
        ]);
    }
}
