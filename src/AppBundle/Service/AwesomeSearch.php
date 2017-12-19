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

        // foreach words, look if it's in title, or drescription, or bool

        foreach($words as $word){

            $titleResults = $this->em->getRepository(SoftMain::class)->searchInTitles();

        }

    }

    private function cleanQuery($query){

        // Receive  a dirty query, give a clean array of words to explore

        //explode

        //delete no effience words

        return $array;

    }


}