<?php

namespace AppBundle\Controller;

use AppBundle\Entity\SoftMain;
use AppBundle\Entity\SoftSeeAlso;
use AppBundle\Entity\Tag;
use AppBundle\Entity\Versus;
use AppBundle\Form\CompareType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use SensioLabs\Security\Exception\HttpException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Service\SiteMap;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Service\BoolsAsTags;
use AppBundle\Service\SeeAlso;
use AppBundle\Service\AwesomeSearch;

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
     * @param string $slug
     * @param SeeAlso $seeAlso
     * @param BoolsAsTags $boolsAsTags
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/logiciels/{slug}", name="softwareSolo")
     */
    public function softwareSoloAction(string $slug, SeeAlso $seeAlso, BoolsAsTags $boolsAsTags)
    {
        /** @var SoftMain $softMain */
        $softMain = $this->getDoctrine()->getRepository(SoftMain::class)->findOneBy(array("slug" => $slug));
        //Fetch see also and booleans
        $seeAlso = $softMain->getSoftSeeAlso();

        if ($seeAlso !== null)
        {
            $result = $seeAlso->getSoftSeeAlsoArray();
            $bools = $seeAlso->getBooleans();

        } else {
            $result = null;
            $bools = null;
        }

        //Fetch Versus list
        $versusList = $this->getDoctrine()->getRepository(Versus::class)->findVersusByOneSoftware($softMain);

        return $this->render('default/software.html.twig', [
            'softmain' => $softMain,
            'versusList' => $versusList,
            'seeAlso' => $result,
            'bools' => $bools,
        ]);
    }
    private static function compareSoftNames(SoftMain $softMain1, SoftMain $softMain2)
    {
        return strcmp($softMain1->getName(), $softMain2->getName());
    }
    /**
     * @Route("logiciels", name="listingSoftware")
     */
    public function listingSoftwareAction(Request $request)
    {

        $repository = $this->getDoctrine()->getRepository(SoftMain::class);
        $softMains = $repository->findAll();
        usort($softMains, 'self::compareSoftNames');

        return $this->render('default/listing-software.html.twig', [
            'softwares' => $softMains,
        ]);
    }

    /**
     * @param Request $request
     * @param $researchContent
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("results_{researchContent}", name="results", defaults={"researchContent": ""})
     */

    public function resultsAction(Request $request, $researchContent = "", AwesomeSearch $awesomeSearch)
    {
        $this->get("session")->set("researchContent", $researchContent);

        return $this->render('default/results.html.twig', [
            'research' => $researchContent,

        ]);

    }

    /**
     * @param Request $request
     * @param $researchContent
     * @return JsonResponse
     * @Route("resultsJson_{researchContent}", name="resultsJson", defaults={"researchContent": ""})
     */

    public function resultsJsonAction(Request $request, $researchContent = "", AwesomeSearch $awesomeSearch)
    {
        $softwares = $awesomeSearch->search($researchContent);
        if ($request->isXmlHttpRequest()) {

            return new JsonResponse(array('data' => $softwares));
        } else {
            throw new HttpException('500', 'Invalid call');
        }
    }

     /**
     * @param array $a
     * @param array $b
     * @return mixed
     */
    private static function compareTags(array $a, array $b) {
        return $b['number'] - $a['number'];
    }


    /**
     * @Route("listing-tags", name="OldlistingTags")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function oldListingTagsAction(Request $request)
    {
        //TODO : passer dans HTAccess
        return $this->redirectToRoute('listingTags', array(), 301);
    }

    /**
     * @Route("tag", name="listingTags")
     * @param Request $request
     * @param BoolsAsTags $boolsAsTags
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listingTagsAction(Request $request, BoolsAsTags $boolsAsTags)
    {

        $bools = $boolsAsTags->getGoodBools();
        $repository = $this->getDoctrine()->getRepository(Tag::class);
        $tags = $repository->findAll();

        foreach ($tags as $tag) {
            $bools[] = array('slug' => $tag->getSlug(), 'number' => count($tag->getSoftMains()), 'entitie' => $tag->getName());
        }

        usort($bools, 'self::compareTags');


        return $this->render('default/listing-tags.html.twig', [
            'bools' => $bools,
        ]);
    }

    /**
     * @Route("tag/{slug}", name="tagSolo")
     * @param Request $request
     * @param BoolsAsTags $boolsAsTags
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function tagAction(Request $request, string $slug, BoolsAsTags $boolsAsTags)
    {

        $repository = $this->getDoctrine()->getRepository(Tag::class);
        $tag = $repository->findOneBy(['slug' => $slug]);
        if (empty($tag)) {
            $softwares = $boolsAsTags->getListSoftwaresByEntitieSlug($slug);
            $boolean = $boolsAsTags->getDescriptionBySlug($slug);;
            return $this->render('default/unique-tag.html.twig', [
                'softwares' => $softwares,
                'boolean' => $boolean,
            ]);
        }

        return $this->render('default/unique-tag.html.twig', [
            'tag' => $tag,
        ]);
    }

    /**
     * @Route("mentions-legales", name="mentionsLegales")
     */
    public
    function mentionsLegalesAction(Request $request)
    {

        return $this->render('default/mentions-legales.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("a-propos", name="a-propos")
     */
    public function  aProposAction(Request $request)
    {

        return $this->render('default/a-propos.html.twig', [
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

    private static function compare(Versus $a, Versus $b)
    {
        return strcmp($a->getSoftware1()->getName(), $b->getSoftware1()->getName());
    }

    /**
     * @Route("comparatifs", name="listingVersus")
     */
    public
    function listingVersusAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $listVersus = $em->getRepository(Versus::class)->findAll();


        usort($listVersus, "self::compare");

        $defaultData = array(
            'message' => 'Choisissez 2 logiciels à comparer :',
        );

        $form = $this->createForm(CompareType::class, $defaultData);

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


            if (empty($soft1) or empty($soft2)) {

                $softwareNotEntity = "Merci de sélectionner un logiciel existant dans la liste déroulante";
                return $this->render('default/listing-versus.html.twig', array(
                    'form' => $form->createView(),
                    'listVersus' => $listVersus,
                    'error' => $softwareNotEntity,

                ));

            } elseif ($soft1 === $soft2) {

                $sameSoftwares = "Vous ne pouvez pas comparer deux fois le même logiciel car c'est inutile";
                return $this->render('default/listing-versus.html.twig', array(
                    'form' => $form->createView(),
                    'listVersus' => $listVersus,
                    'error' => $sameSoftwares,
                ));

            } else {
                $this->get("session")->set("versus1", $soft1->getName());
                $this->get("session")->set("versus2", $soft2->getName());
                return $this->redirectToRoute('versus', array(
                    'slug1' => $soft1->getSlug(),
                    'slug2' => $soft2->getSlug(),
                ));
            }

        }

        return $this->render('default/listing-versus.html.twig', array(
            'form' => $form->createView(),
            'listVersus' => $listVersus,

        ));
    }

    /**
     * @Route("comparatifs/{slug1}_vs_{slug2}", name="versus")
     */

    public function VersusAction(Request $request, string $slug1, string $slug2)

    {
        $canonical = array($slug1, $slug2);
        sort($canonical);

        $em = $this->getDoctrine()->getManager();


        $softmain1 = $em->getRepository('AppBundle:SoftMain')->findOneBy([
            'slug' => $slug1
        ]);

        $softmain2 = $em->getRepository('AppBundle:SoftMain')->findOneBy([
            'slug' => $slug2
        ]);

        // Look for existing versus
        $versus = $em->getRepository('AppBundle:Versus')->findWithSoftNames($softmain1->getId(), $softmain2->getId());

        // if versus is not existing this way, test if it's existing in the other way
        if (empty($versus)) {
            $versus = $em->getRepository('AppBundle:Versus')->findWithSoftNames($softmain2->getId(), $softmain1->getId());
        }
        $name1 = $softmain1->getName();
        $name2 = $softmain2->getName();
        $defaultData = array(
            'message' => 'Choisissez 2 logiciels à comparer :',
            'placeholder1' => $name1,
            'placeholder2' => $name2,
        );
        $form = $this->createForm(CompareType::class, $defaultData);

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

            if (empty($soft1) or empty($soft2)) {
                $error = "Merci de sélectionner un logiciel existant dans la liste déroulante";
                return $this->render('default/compare.html.twig', array(
                        'form' => $form->createView(),
                        'softmain1' => $softmain1,
                        'softmain2' => $softmain2,
                        'error' => $error,
                    )
                );
            } elseif ($soft1 === $soft2) {
                $error = "Merci de ne pas sélectionner deux fois le même logiciel";
                return $this->render('default/compare.html.twig', array(
                        'form' => $form->createView(),
                        'softmain1' => $softmain1,
                        'softmain2' => $softmain2,
                        'error' => $error,
                    )
                );
            } else {
                $this->get("session")->set("versus1", $soft1->getName());
                $this->get("session")->set("versus2", $soft2->getName());
                return $this->redirectToRoute('versus', array('slug1' => $soft1->getSlug(), 'slug2' => $soft2->getSlug()));
            }
        }

        return $this->render('default/compare.html.twig', array(
                'form' => $form->createView(),
                'softmain1' => $softmain1,
                'softmain2' => $softmain2,
                'versus' => $versus,
                'canonical' => $canonical
            )
        );
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
        $query = $request->query->get('search');
        return $this->redirectToRoute('results', array('researchContent' => $query));
    }


    /**
     * @Route("bonnes-pratiques", name="goodPractices")
     */
    public
    function goodPracticesAction(Request $request)
    {

        return $this->render('default/methodology.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
        ]);
    }


}
