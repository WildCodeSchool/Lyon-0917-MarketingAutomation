<?php

namespace AppBundle\Controller;

use AppBundle\Entity\SoftMain;
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
     * @param Request $request
     * @param $researchContent
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("results_{researchContent}", name="results")
     * @Method("GET")
     */

    public
    function resultsAction(Request $request, $researchContent)
    {
        $this->get("session")->set("researchContent", $researchContent);
        $serviceRecherche = $this->container->get('app.search');

        $softwares = $serviceRecherche->search($researchContent);


        return $this->render('default/results.html.twig', [
            'softwares' => $softwares,
            'research' => $researchContent
        ]);
    }

    /**
     * @Route("listing-tags", name="listingTags")
     * @param Request $request
     * @param BoolsAsTags $boolsAsTags
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public
    function listingTagsAction(Request $request, BoolsAsTags $boolsAsTags)
    {

        $bools = $boolsAsTags->getGoodBools();
        $repository = $this->getDoctrine()->getRepository(Tag::class);
        $tags = $repository->findAll();
        return $this->render('default/listing-tags.html.twig', [
            'tags' => $tags,
            'bools' => $bools,
        ]);
    }

    /**
     * @Route("tag/{slug}", name="tagSolo")
     * @param Request $request
     * @param BoolsAsTags $boolsAsTags
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public
    function tagAction(Request $request, string $slug, BoolsAsTags $boolsAsTags)
    {

        $repository = $this->getDoctrine()->getRepository(Tag::class);
        $tag = $repository->findOneBy(['slug' => $slug]);
        if (empty($tag)) {
            $softwares = $boolsAsTags->getListSoftwaresByEntitieSlug($slug);
            return $this->render('default/unique-tag.html.twig', [

                'softwares' => $softwares,
                'description' => $boolsAsTags->getDescriptionBySlug($slug),
            ]);
        }

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
}
