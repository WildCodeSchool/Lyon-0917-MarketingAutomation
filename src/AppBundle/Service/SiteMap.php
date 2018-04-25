<?php

namespace AppBundle\Service;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\Routing\RouterInterface;
use AppBundle\Entity\Tag;
use AppBundle\Service\BoolsAsTags;


class SiteMap
{

    /** @var Router  */
    private $router;
    /**
     * @var ObjectManager
     */
    private $em;
    /**
     * @var BoolsAsTags
     */
    private $boolsAsTags;

    /**
     * SiteMap constructor.
     * @param RouterInterface $router
     * @param ObjectManager $em
     * @param \AppBundle\Service\BoolsAsTags $boolsAsTags
     */

    public function __construct(RouterInterface $router, ObjectManager $em, BoolsAsTags $boolsAsTags)
    {
        $this->router = $router;
        $this->em = $em;
        $this->boolsAsTags = $boolsAsTags;
    }

    /**
     * Generate all routes of website list in controller and in database
     *
     * @return array
     */
    public function generate()


    {
        // Add softwares to list of urls
        $softwares = $this->em->getRepository('AppBundle:SoftMain')->findAll();
        $urls = [];

        foreach ($softwares as $software) {
            $urls[] = array(
                'loc' => $this->router->generate('softwareSolo', array('slug' => $software->getSlug()), true)
            );
        }

        // Add tags to list of urls
        $tags = $this->em->getRepository(Tag::class)->findAll();
        foreach($tags as $tag) {
            $urls[] = array(
                'loc' => $this->router->generate('tagSolo', array('slug' => $tag->getSlug()), true)
            );
        }

        // Add booleans to list of urls
        $bools = $this->boolsAsTags->getGoodBools();
        foreach($bools as $bool) {
            $urls[] = array('loc' => $this->router->generate('tagSolo', array('slug' => $bool['slug']), true));
        }

        // Add versus to lis of urls

        $versus = $this->em->getRepository("AppBundle:Versus")->findAll();
        $versusLight = array();
        foreach($versus as $versu) {
            $versusLight[] = array($versu->getSoftware1()->getSlug(), $versu->getSoftware2()->getSlug());
        }
        foreach($versusLight as $each) {
            sort($each);
            $urls[] = array('loc' => $this->router->generate('versus', array('slug1' => $each[0], 'slug2' => $each[1]), true));
        }

        $routes = $this->router->getRouteCollection()->all();
        foreach($routes as $route) {
            $pattern = '(^(\/_))';
            $path = $route->getPath();
            if (!preg_match('/\/admin/', $path) and !preg_match($pattern, $path) and (!preg_match('/\/sitemap/', $path)) and (!preg_match('/\/result/', $path)) and (!preg_match('/slug/', $path)) and (!preg_match('/softmain/', $path)) and (!preg_match('/searchAction/', $path)))
            {
                $urls[] = array(
                    'route' => $path
                );
            };
        }

        return $urls;
    }
}
