<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
     * @Route("/logiciels/slug-logiciel", name="softwareSolo")
     */
    public function softwareSoloAction(Request $request)
    {

        return $this->render('default/software.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("logiciels", name="listingSoftware")
     */
    public function listingSoftwareAction(Request $request)
    {

        return $this->render('default/listing-software.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("results", name="results")
     */
    public function resultsAction(Request $request)
    {

        return $this->render('default/results.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("tags", name="listingTags")
     */
    public function listingTagsAction(Request $request)
    {

        return $this->render('default/tags.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("mentionsLegales", name="mentionsLegales")
     */
    public function mentionsLegalesAction(Request $request)
    {

        return $this->render('default/mentions-legales.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("contact", name="contact")
     */
    public function contactAction(Request $request)
    {

        return $this->render('default/contact.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("comparatifs", name="listingVersus")
     */
    public function listingVersusAction(Request $request)
    {

        return $this->render('default/listing-versus.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("comparatifs/slug-vs-slug", name="Versus")
     */
    public function VersusAction(Request $request)
    {

        return $this->render('default/compare.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
        ]);
    }

}
