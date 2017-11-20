<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Service\SiteMap;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/logiciels/slug-logiciel/", name="softwareSolo")
     */
    public function softwareSoloAction(Request $request)
    {
        $slug = 'slug';
        return $this->render('default/software.html.twig', [
            'slug' => $slug,
        ]);
    }

    /**
     * @Route("/logiciels/", name="listingSoftware")
     */
    public function listingSoftwareAction(Request $request)
    {

        return $this->render('default/listing-software.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/results/", name="results")
     */
    public function resultsAction(Request $request)
    {

        return $this->render('default/results.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/listing-tags/", name="listingTags")
     */
    public function listingTagsAction(Request $request)
    {

        return $this->render('default/listing-tags.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/tag/", name="tagSolo")
     */
    public function tagAction(Request $request)
    {

        return $this->render('default/unique-tag.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
        ]);
    }
    /**
     * @Route("/mentionsLegales/", name="mentionsLegales")
     */
    public function mentionsLegalesAction(Request $request)
    {

        return $this->render('default/mentions-legales.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/contact/", name="contact")
     */
    public function contactAction(Request $request)
    {

        return $this->render('default/contact.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/comparatifs/", name="listingVersus")
     */
    public function listingVersusAction(Request $request)
    {

        return $this->render('default/listing-versus.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * Generate sitemap for site
     *
     * @Route("/sitemap.{_format}/", name="sitemap", Requirements={"_format" = "xml"})
     */
    public function siteMapAction(SiteMap $siteMap)
    {
        $urls = $siteMap->generate();

        return $this->render('default/sitemap.html.twig', [
            'urls' => $urls,
        ]);
    }

    /**
     * @Route("/comparatifs/slug-vs-slug/", name="versus")
     */
    public function VersusAction(Request $request)
    {

        return $this->render('default/compare.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,

        ]);
    }

}
