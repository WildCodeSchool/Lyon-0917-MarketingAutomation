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

    public function __construct(Router $router, ObjectManager $em, Controller $controller)
    {
        $this->router = $router;
        $this->em = $em;
        $this->controller = $controller;
    }

    /**
     * Generate all routes of website
     *
     * @return array
     */
    public function generate()
    {

        $urls = $this->router->getRouteCollection();

        return $urls;
    }
}
