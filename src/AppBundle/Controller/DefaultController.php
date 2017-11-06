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
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("software", name="softwareSolo")
     */
    public function softwareSoloAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/software.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("listing-software", name="listingSoftware")
     */
    public function listingSoftwareAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/listing-software.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("results", name="results")
     */
    public function resultsAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/results.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("tags", name="listingTags")
     */
    public function listingTagsAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/tags.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("mentionsLegales", name="mentionsLegales")
     */
    public function mentionsLegalesAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/mentions_legales.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

}
