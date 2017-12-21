<?php


namespace AppBundle\Service;

use AppBundle\Entity\SoftInfo;
use AppBundle\Entity\SoftMain;
use AppBundle\Entity\SoftSupport;
use AppBundle\Entity\Tag;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Yaml\Yaml;


class AwesomeSearch
{


    private $em;

    private $searchYml;

    private $resultFinal;


    const BOOLPOINT = 1;
    const TAGPOINT = 2;
    const CONTENTPOINT = 3;
    const NAMEPOINT = 5;


    /**
     * AwesomeSearch constructor.
     * @param $em
     */
    public function __construct(EntityManagerInterface $em, $rootDir)
    {
        $this->em = $em;
        $this->resultFinal = array();
        $this->searchYml = Yaml::parse(file_get_contents($rootDir . "/config/awesomeSearch.yml"));

    }


    public function search($query)
    {

        // Here, we get a query, return an array with results sorts

        $words = $this->cleanQuery($query);
        $finalResult = [];


        // foreach words, look if it's in title, or drescription, or bool

        foreach ($words as $word) {


            $softmainNameResults = $this->em->getRepository(SoftMain::class)->searchInSoftmainName($word);
            $this->addPertinencePoint($softmainNameResults, self::NAMEPOINT);


            $softmainDescriptionResults = $this->em->getRepository(SoftMain::class)->searchInSoftmainDescription($word);
            $this->addPertinencePoint($softmainDescriptionResults, self::CONTENTPOINT);


            $commentResults = $this->em->getRepository(SoftMain::class)->searchInComment($word);
            $this->addPertinencePoint($commentResults, self::CONTENTPOINT);


            $advantagesResults = $this->em->getRepository(SoftMain::class)->searchInAdvantages($word);
            $this->addPertinencePoint($advantagesResults, self::CONTENTPOINT);


            $drawbacksResults = $this->em->getRepository(SoftMain::class)->searchInDrawbacks($word);
            $this->addPertinencePoint($drawbacksResults, self::CONTENTPOINT);


            $typeResults = $this->em->getRepository(SoftMain::class)->searchInType($word);
            $this->addPertinencePoint($typeResults, self::CONTENTPOINT);


            $customersResults = $this->em->getRepository(SoftInfo::class)->searchInCustomers($word);
            $this->addPertinencePoint($customersResults, self::CONTENTPOINT);


            $hostingCountryResults = $this->em->getRepository(SoftInfo::class)->searchInHostingCountry($word);
            $this->addPertinencePoint($hostingCountryResults, self::CONTENTPOINT);


            $creationDateResults = $this->em->getRepository(SoftInfo::class)->searchInCreationDate($word);
            $this->addPertinencePoint($creationDateResults, self::CONTENTPOINT);

            $webSiteResults = $this->em->getRepository(SoftInfo::class)->searchInWebSite($word);
            $this->addPertinencePoint($webSiteResults, self::CONTENTPOINT);

            $knowledgeBaseLanguageResults = $this->em->getRepository(SoftSupport::class)->searchInKnowledgeBaseLanguage($word);
            $this->addPertinencePoint($knowledgeBaseLanguageResults, self::CONTENTPOINT);


            $tagNameResults = $this->em->getRepository(Tag::class)->searchInTagName($word);
            $this->addPertinencePoint($tagNameResults, self::TAGPOINT);


            $tagDescriptionResults = $this->em->getRepository(Tag::class)->searchInTagDescription($word);
            $this->addPertinencePoint($tagDescriptionResults, self::TAGPOINT);

            $boolResults = $this->searchInYml($word);
        }

        return $finalResult;
    }

    private function cleanQuery($query)
    {

        // Receive  a dirty query, give a clean array of words to explore

        $arrayOfWords = preg_split("/[\s,+\"'&%().]+/", $query);
        $goodQuery = [];
        $emptyWords = $this->getSearchYml()["EmptyWords"];

        foreach ($arrayOfWords as $word) {
            $isDirtyOrNot = in_array($word, $emptyWords);
            if ($isDirtyOrNot === false AND strlen($word)) {
                $goodQuery[] .= $word;
            }
        }

        return $goodQuery;
    }

    public function searchInYml($word)
    {
        $resultTable = [];
        $j = 0;
        $entityKeys = array_keys($this->getSearchYml()['Booleans']);
        foreach ($this->getSearchYml()['Booleans'] as $table) {
            $i = 0;
            $booleanKeys = array_keys($table);
            foreach ($table as $synonym) {
                if (stristr($synonym, $word) != FALSE) {
                    $resultTable = $this->em->getRepository(SoftMain::class)->getSoftByAnyBool($booleanKeys[$i], $entityKeys[$j]);
                    $this->addPertinencePoint($resultTable, self::BOOLPOINT);
                    //Version finale: ajouter cette methode pour ajouter chaque resultat à la proprieté finale
                    //$this->addToFinalResult($resultTable);
                }
                $i++;
            }
            $j++;
        }
        //Cette function DOIT return uniquement true, mais elle ajoute à final result tous les tableaux trouvés par la query. À LA VERSION FINAL: remplacer par return true
        return $resultTable;
    }

// cette fonction prend en argument un array et parcourt le resultFinal, lajoute chaque ligne de l'array si elle n'existe pas ou alors ajoute à l'id deja existant
    public function addToFinalResult($array)
    {
        foreach ($array as $result) {
            $i = 0;
            foreach ($this->resultFinal as $resultFinalLign) {
                if ($result['soft'] === $resultFinalLign['soft']) {
                    $this->resultFinal[$i]['points'] += $result['points'];
                    $result['points'] = 0;
                }
                $i++;
            }
            if ($result['points'] != 0) {
                array_push($this->resultFinal, $result);
            }
        }
        return true;
    }

    public function addPertinencePoint(array $results, $pertinencePoint)
    {
        $resultsPoint = [];

        for ($i = 0; $i < count($results); $i++) {

            $soft = array('soft' => $results[$i]);
            $point = array('point' => $pertinencePoint);

            $resultsPoint[] = $soft + $point;
            //Version finale: ajouter cette methode pour ajouter chaque resultat à la proprieté finale
            //$this->addToFinalResult($resultTable);
        }

        return $resultsPoint;

    }


    /**
     * @return EntityManagerInterface
     */
    public function getEm()
    {
        return $this->em;
    }

    /**
     * @return mixed
     */
    public function getSearchYml()
    {
        return $this->searchYml;
    }

    /**
     * @return array
     */
    public function getResultFinal()
    {
        return $this->resultFinal;
    }
}