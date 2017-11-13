<?php

namespace AppBundle\Service;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SiteMap
{

    /** @var Router  */
    private $router;
    private $em;
    private $controller;

    public function __construct(RouterInterface $router, ObjectManager $em, Controller $controller)
    {
        $this->router = $router;
        $this->em = $em;
        $this->controller = $controller;
    }

    /**
     * Generate all routes of website list in controller
     *
     * @return array
     */
    public function generate()
    {

        $routes = $this->router->getRouteCollection()->all();
        $urls = [];
        foreach($routes as $route) {
            $pattern = '(^(\/_))';
            $path = $route->getPath();
                if (!preg_match($pattern, $path) and (!preg_match('/\/sitemap/', $path)) and (!preg_match('/\/result/', $path)) and (!preg_match('/\/slug/', $path)))
                {
                    $urls[] = $path;
                };
            }

        return $urls;
    }
}
