<?php



namespace AppBundle\Service;

use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Entity\SoftMain;
use AppBundle\Entity\SoftInfo;
use AppBundle\Entity\SoftSupport;
use AppBundle\Entity\Tag;


class AwesomeSearch
{

    private $em;

    /**
     * AwesomeSearch constructor.
     * @param $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }


    public function search($query){

        // Here, we get a query, return an array with results sorts

        $words = $this->cleanQuery($query);
        $finalResult = [];


        // foreach words, look if it's in title, or drescription, or bool

        foreach($words as $word){

            $softmainNameResults = $this->em->getRepository(SoftMain::class)->searchInSoftmainName($word);
            $softmainDescriptionResults = $this->em->getRepository(SoftMain::class)->searchInSoftmainDescription($word);
            $commentResults = $this->em->getRepository(SoftMain::class)->searchInComment($word);
            $advantagesResults = $this->em->getRepository(SoftMain::class)->searchInAdvantages($word);
            $drawbacksResults = $this->em->getRepository(SoftMain::class)->searchInDrawbacks($word);
            $typeResults = $this->em->getRepository(SoftMain::class)->searchInType($word);
            $customersResults = $this->em->getRepository(SoftInfo::class)->searchInCustomers($word);
            $hostingCountryResults = $this->em->getRepository(SoftInfo::class)->searchInHostingCountry($word);
            $creationDateResults = $this->em->getRepository(SoftInfo::class)->searchInCreationDate($word);
            $webSiteResults = $this->em->getRepository(SoftInfo::class)->searchInWebSite($word);
            $knowledgeBaseLanguageResults = $this->em->getRepository(SoftSupport::class)->searchInKnowledgeBaseLanguage($word);
            $tagNameResults = $this->em->getRepository(Tag::class)->searchInTagName($word);
            $tagDescriptionResults = $this->em->getRepository(Tag::class)->searchInTagDescription($word);

            $boolResults = $this->searchInYml($word);


        }

        return $finalResult;

    }

    private function cleanQuery($query){

        // Receive  a dirty query, give a clean array of words to explore

        //explode

        //delete no effience words

        return $array;

    }


    private function searchInYml($word){
        //Search word an synonym in

        return $array;
    }




}