<?php


namespace AppBundle\Service;

use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Entity\SoftMain;
use Symfony\Component\Yaml\Yaml;
use AppBundle\Repository\SoftMainRepository;

class AwesomeSearch
{

    private $em;

    private $searchYml;

    private $resultFinal;


    const BOOLPOINT = 1;


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
        $booleanKeys = array_keys($this->getSearchYml()['Booleans']);
        foreach ($this->getSearchYml()['Booleans'] as $synonym) {
            if (stristr($synonym, $word) != FALSE) {
                $resultTable = $this->em->getRepository(SoftMain::class)->getSoftByAnyBool($booleanKeys[$i]);
                $this->addToFinalResult($resultTable);
            }
            $i++;
        }
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
            if($result['points'] != 0){
                array_push($this->resultFinal,$result);
            }
        }
        return true;
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