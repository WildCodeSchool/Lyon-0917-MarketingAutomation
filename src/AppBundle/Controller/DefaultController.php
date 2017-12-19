<?php

namespace AppBundle\Controller;

use AppBundle\Entity\SoftMain;
use AppBundle\Entity\Tag;
use AppBundle\Entity\Versus;
use AppBundle\Repository\SoftMainRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Service\SiteMap;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use SensioLabs\Security\Exception\HttpException;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render(':default:index.html.twig', array());
    }

    /**
     * @Route("/logiciels/{slug}", name="softwareSolo")
     * @Method("GET")
     */
    public
    function softwareSoloAction(Request $request, SoftMain $softMain)
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
    public
    function listingSoftwareAction(Request $request)
    {

        $repository = $this->getDoctrine()->getRepository(SoftMain::class);
        $softMains = $repository->findAll();
        return $this->render('default/listing-software.html.twig', [
            'softwares' => $softMains,
        ]);
    }

    /**
     * @Route("results_{researchContent}", name="results")
     * @Method("GET")
     */
    public
    function resultsAction(Request $request, $researchContent)
    {
        $em = $this->getDoctrine()->getManager();
        $tableDatas = explode(" ", $researchContent);
        $results = [];
        for ($i = 0; $i < count($tableDatas); $i++) {
            $uniqueResult = $em->getRepository('AppBundle:SoftMain')->findOneBy([
                'name' => $tableDatas[$i]
            ]);
            if ($uniqueResult != null) {
                array_push($results, $uniqueResult);
            }
        }
        return $this->render('default/results.html.twig', [
            'softwares' => $results,
        ]);
    }

    /**
     * @Route("listing-tags", name="listingTags")
     */
    public
    function listingTagsAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Tag::class);
        $tags = $repository->findAll();
        return $this->render('default/listing-tags.html.twig', [
            'tags' => $tags,
        ]);
    }

    /**
     * @Route("tag/{slug}", name="tagSolo")
     */
    public
    function tagAction(Request $request, Tag $tag)
    {
        return $this->render('default/unique-tag.html.twig', [

            'tag' => $tag,

        ]);
    }

    /**
     * @Route("mentionsLegales", name="mentionsLegales")
     */
    public
    function mentionsLegalesAction(Request $request)
    {

        return $this->render('default/mentions-legales.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("contact", name="contact")
     */
    public
    function contactAction(Request $request)
    {

        return $this->render('default/contact.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("comparatifs", name="listingVersus")
     */
    public
    function listingVersusAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $listVersus = $em->getRepository(Versus::class)->findAll();

        $defaultData = array('message' => 'Choisissez 2 logiciels à comparer :');
        $form = $this->createFormBuilder($defaultData)
            ->add('software1',
                TextType::class,
                array('label' => 'Choisir le premier logiciel :', 'attr' => array('autocomplete' => 'off')))
            ->add('software2',
                TextType::class,
                array('label' => 'Choisir le premier logiciel :', 'attr' => array('autocomplete' => 'off')))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // data is an array with "software1", "software2"
            $data = $form->getData();
            $soft1 = $em->getRepository('AppBundle:SoftMain')->findOneBy([
                'name' => $data["software1"]
            ]);
            $soft2 = $em->getRepository('AppBundle:SoftMain')->findOneBy([
                'name' => $data["software2"]
            ]);


            return $this->redirectToRoute('versus', array('slug1' => $soft1->getSlug(), 'slug2' => $soft2->getSlug()));
        }


        return $this->render('default/listing-versus.html.twig', array(
            'form' => $form->createView(),
            'listVersus' => $listVersus,
        ));
    }

    /**
     * @Route("comparatifs/slug1-vs-slug2", name="versus")
     */
    public
    function VersusAction(Request $request)
    {

        return $this->render('default/compare.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,

        ]);
    }

    /**
     * Generate sitemap for site
     *
     * @Route("/sitemap.{_format}", name="sitemap", Requirements={"_format" = "xml"})
     */
    public
    function siteMapAction(SiteMap $siteMap)
    {
        $urls = $siteMap->generate();
        return $this->render('default/sitemap.html.twig', [
            'urls' => $urls,
        ]);
    }

    /**
     * @param Request $request
     * @param $softmain
     * @return JsonResponse
     * @Route("/comparatifs/list/{softmain}", name="list-softmain")
     */

    public
    function autocompleteAction(Request $request, $softmain)
    {
        if ($request->isXmlHttpRequest()) {

            $repository = $this->getDoctrine()->getRepository('AppBundle:SoftMain');
            $data = $repository->getSoftMainByName($softmain);
            return new JsonResponse(array("data" => json_encode($data)));
        } else {
            throw new HttpException('500', 'Invalid call');
        }

    }
    /**
     * @Route("searchAction", name="searchAction")
     * @Method("GET")
     */
    public function searchAction(Request $request)
    {
        if($_GET['search'] != null){
            return $this->redirectToRoute('results', array('researchContent' => $_GET['search']));
        }

    }
}