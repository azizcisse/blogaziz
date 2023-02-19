<?php

namespace App\Controller\Admin;

use App\Entity\Menu;
use App\Entity\User;
use App\Entity\Media;
use App\Entity\Option;
use App\Entity\Article;
use App\Entity\Comment;
use App\Entity\Category;
use Symfony\Component\HttpFoundation\Response;
use App\Controller\Admin\ArticleCrudController;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    public function __construct(private AdminUrlGenerator $adminUrlGenerator)
    {}
    #[Route('/admin', name:'admin')]
function index(): Response
    {
    $url = $this->adminUrlGenerator->setController(ArticleCrudController::class)
        ->generateUrl();

    return $this->redirect($url);
}

function configureDashboard(): Dashboard
    {
    return Dashboard::new ()
        ->setTitle("CMS-D'AZIZ");
}

function configureMenuItems(): iterable
    {
    yield MenuItem::linkToRoute('Aller Sur le Site', 'fa fa-undo', 'app_accueil');

    if ($this->isGranted('ROLE_ADMIN')) {
        yield MenuItem::subMenu('Menus', 'fas fa-list')->setSubItems([
            MenuItem::linkToCrud('Pages', 'fas fa-file', Menu::class),
            MenuItem::linkToCrud('Articles', 'fas fa-newspaper', Menu::class),
            MenuItem::linkToCrud('Liens personnalisés', 'fas fa-link', Menu::class),
            MenuItem::linkToCrud('Catégories', 'fab fa-delicious', Menu::class),
        ]);
    }

    if ($this->isGranted('ROLE_AUTHOR')) {
        yield MenuItem::subMenu('Articles', 'fas fa-newspaper')->setSubItems([
            MenuItem::linkToCrud('Tous les Articles', 'fas fa-newspaper', Article::class),
            MenuItem::linkToCrud('Ajouter', 'fas fa-plus', Article::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Catégories', 'fas fa-list', Category::class),
        ]);

        yield MenuItem::subMenu('Média', 'fas fa-photo-video')->setSubItems([
            MenuItem::linkToCrud('Médiatèque', 'fas fa-photo-video', Media::class),
            MenuItem::linkToCrud('Ajouter', 'fas fa-plus', Media::class)->setAction(Crud::PAGE_NEW),
        ]);
    }

    if ($this->isGranted('ROLE_ADMIN')) {
        yield MenuItem::linkToCrud('Commentaires', 'fa fa-comment', Comment::class);

        yield MenuItem::subMenu('Comptes', 'fas fa-user')->setSubItems([
            MenuItem::linkToCrud('Liste des Comptes', 'fas fa-user-friends', User::class),
            MenuItem::linkToCrud('Ajouter', 'fas fa-plus', User::class)->setAction(Crud::PAGE_NEW),
        ]);

        yield MenuItem::subMenu('Réglages', 'fas fa-cog')->setSubItems([
            MenuItem::linkToCrud('Général', 'fas fa-cog', Option::class),
        ]);
    }

}

}
