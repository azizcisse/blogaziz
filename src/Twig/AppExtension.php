<?php

namespace App\Twig;

use App\Entity\Menu;
use Twig\TwigFilter;
use Twig\TwigFunction;
use App\Twig\AppExtension;
use Twig\Extension\AbstractExtension;
use Symfony\Component\Routing\RouterInterface;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;


class AppExtension extends AbstractExtension
{
    const ADMIN_NAMESPACE = 'App\Controller\Admin';

    public function __construct(
        private RouterInterface $route, 
        private AdminUrlGenerator $adminUrlGenerator
        )
    {

    }
      public function getFilters(): array
      {
        return [
            new TwigFilter('menuLink', [$this, 'menuLink'])
        ];
      }

      public function getFunctions(): array
      {
        return [
            new TwigFunction('ea_index', [$this, 'getAdminUrl'])
        ];
      }
    
      public function getAdminUrl(string $controller)
      {
        return $this->adminUrlGenerator
        ->setController(self::ADMIN_NAMESPACE, DIRECTORY_SEPARATOR . $controller)
           ->generateUrl();
      }

      public function menuLink(Menu $menu): string
      {
        $article = $menu->getArticle();
        $category = $menu->getCatégory();
        $page = $menu->getPage();

        $url = $menu->getLink() ?: '#';

        if ($url != '#') {
            return $url;
        }

        if ($article) {
            $name = 'article_show'; 
            $slug = $article->getSlug();
        }

        if ($category) {
            $name = 'category_show'; 
            $slug = $category->getSlug();
        }

        if ($page) {
            $name = 'page_show'; 
            $slug = $page->getSlug();
        }

        if (!isset($name, $slug)) {
            return $url;
        }
        
        return $this->router->generate($name, [
               'slug' => $slug,
        ]);
      }
}