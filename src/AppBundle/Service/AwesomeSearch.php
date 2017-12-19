<?php



namespace AppBundle\Service;

use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Entity\SoftMain;

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

            $nameResults = $this->em->getRepository(SoftMain::class)->searchInNames($word);
            $descriptionResults = $this->em->getRepository(SoftMain::class)->searchInDescriptions($word);
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