<?php


namespace AppBundle\Service;

use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Entity\SoftMain;
use Symfony\Component\Yaml\Yaml;

class AwesomeSearch
{

    private $em;

    private $booleanSynonyms;

    private $resultFinal;

    private $pointForBoolean;

    const BOOLPOINT = 10;


    /**
     * AwesomeSearch constructor.
     * @param $em
     */
    public function __construct(EntityManagerInterface $em, $rootDir)
    {
        $this->em = $em;
        $this->resultFinal = array();
        $this->booleanSynonyms = Yaml::parse(file_get_contents($rootDir . "/config/awesomeSearch.yml"));
    }


    public function search($query)
    {

        // Here, we get a query, return an array with results sorts

        $words = $this->cleanQuery($query);
        $finalResult = [];


        // foreach words, look if it's in title, or drescription, or bool

        foreach ($words as $word) {

            $nameResults = $this->em->getRepository(SoftMain::class)->searchInNames($word);
            $descriptionResults = $this->em->getRepository(SoftMain::class)->searchInDescriptions($word);
            $boolResults = $this->searchInYml($word);


        }

        return $finalResult;

    }

    private function cleanQuery($query)
    {

        // Receive  a dirty query, give a clean array of words to explore

        //explode

        //delete no effience words

        return $array;

    }


    private function searchInYml($word)
    {
        $i = 0;
        $booleanKeys = array_keys($this->getBooleanSynonyms()['Booleans']);
        foreach ($this->getBooleanSynonyms()['Booleans'] as $synonym) {
            if (stristr($synonym, $word) != FALSE) {
                $resultTable = queryquireturnlebonarray($booleanKeys[$i]);
                $this->addToFinalResult($resultTable);
            }
            $i++;
        }
    }
// cette fonction prend en argument un array et parcourt le resultFinal, lajoute chaque ligne de l'array si elle n'existe pas ou alors ajoute à l'id deja existant
    public function addToFinalResult($array)
    {
        foreach (array_keys($array) as $result){
            if (isset($this->resultFinal[$result])){
                $this->resultFinal[$result] += $array[$result];
            }else{
                $this->resultFinal[] += $result;
            }
        }
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
    public function getBooleanSynonyms()
    {
        return $this->booleanSynonyms;
    }


}