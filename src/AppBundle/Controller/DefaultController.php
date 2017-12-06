<?php

namespace AppBundle\Controller;

use AppBundle\Entity\SoftMain;
use AppBundle\Entity\Tag;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Service\SiteMap;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


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
     * @Route("/logiciels/{slug}", name="softwareSolo")
     * @Method("GET")
     */
    public function softwareSoloAction(Request $request, SoftMain $softMain)
    {
        $repository = $this->getDoctrine()->getRepository(SoftMain::class);
        $softMains = $repository->findAll();
        return $this->render('default/software.html.twig', [
            'softmain' => $softMain,
            'softwares' => $softMains,
        ]);
    }

    /**
     * @Route("logiciels", name="listingSoftware")
     */
    public function listingSoftwareAction(Request $request)
    {

        $repository = $this->getDoctrine()->getRepository(SoftMain::class);
        $softMains = $repository->findAll();
        return $this->render('default/listing-software.html.twig', [
            'softwares' => $softMains,
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
     * @Route("listing-tags", name="listingTags")
     */
    public function listingTagsAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Tag::class);
        $tags = $repository->findAll();
        return $this->render('default/listing-tags.html.twig', [
            'tags' => $tags,
        ]);
    }

    /**
     * @Route("tag", name="tagSolo")
     */
    public function tagAction(Request $request)
    {

        return $this->render('default/unique-tag.html.twig', [
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

        $em = $this->getDoctrine()->getManager();

        $soft = $em->getRepository('AppBundle:SoftMain')->findAll();

        $defaultData = array('message' => 'Choisissez 2 logiciels à comparer :');
        $form = $this->createFormBuilder($defaultData)
            ->add('software1',
                TextType::class,
                array('attr' => array('autocomplete'=>'off'), 'label' =>'Choisir le premier logiciel :'))
            ->add('software2',
                TextType::class,
                array('attr' => array('autocomplete'=>'off'), 'label' => 'Choisir le second logiciel :'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // data is an array with "software1", "software2"
            $data = $form->getData();
        }


        return $this->render('default/listing-versus.html.twig', array(
            'soft' => $soft,
            'form' => $form->createView(),
        ));
    }

    /**
     * Generate sitemap for site
     *
     * @Route("/sitemap.{_format}", name="sitemap", Requirements={"_format" = "xml"})
     */
    public function siteMapAction(SiteMap $siteMap)
    {
        $urls = $siteMap->generate();
        return $this->render('default/sitemap.html.twig', [
            'urls' => $urls,
        ]);
    }

    /**
     * @Route("comparatifs/slug-vs-slug", name="versus")
     */
    public function VersusAction(Request $request)
    {

        return $this->render('default/compare.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,

        ]);
    }

}
