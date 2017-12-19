<?php

namespace AppBundle\Service;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Controller\DefaultController;


class SiteMap
{

    /** @var Router  */
    private $router;
    private $em;

    public function __construct(RouterInterface $router, ObjectManager $em)
    {
        $this->router = $router;
        $this->em = $em;

    }

    /**
     * Generate all routes of website list in controller
     *
     * @return array
     */
    public function generate()


    {
        $softwares = $this->em->getRepository('AppBundle:SoftMain')->findAll();
        $urls = [];

        foreach ($softwares as $software) {
            $urls[] = array(
                'loc' => $this->router->generate('softwareSolo', array('slug' => $software->getSlug()), true)
            );
        }

        $routes = $this->router->getRouteCollection()->all();
        foreach($routes as $route) {
            $pattern = '(^(\/_))';
            $path = $route->getPath();
            if (!preg_match($pattern, $path) and (!preg_match('/\/sitemap/', $path)) and (!preg_match('/\/result/', $path)) and (!preg_match('/\/slug/', $path)))
            {
                $urls[] = array(
                    'route' => $path
                );
            };
        }

        return $urls;
    }
}
