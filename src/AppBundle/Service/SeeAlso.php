<?php

namespace AppBundle\Service;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Entity\SoftMain;

class SeeAlso
{

    /** @var ObjectManager */
    private $em;

    /** @var AwesomeSearch */
    private $awesomeSearch;

    /**
     * SeeAlso constructor.
     * @param EntityManagerInterface $em
     * @param AwesomeSearch $awesomeSearch
     * Use AwesomeSearch to give an array of softwares same as one
     */
    public function __construct(EntityManagerInterface $em, AwesomeSearch $awesomeSearch)
    {
        $this->em = $em;
        $this->awesomeSearch = $awesomeSearch;

    }

    /**
     * @param $software
     * @return string
     * Give a string with all tags of given software, to look for same softwares.
     */
    public function getListTagsToString($software) {

        $softMains = $this->em->getRepository(SoftMain::class)->createQueryBuilder('s')
            ->where('s.name LIKE :name')
            ->setParameter('name', $software)
            ->getQuery()->getResult();

        $query = "";

        foreach($softMains as $softMain) {
            $listTags = $softMain->getTags();
            foreach($listTags as $tag) {
                $query .= $tag->getName();
                $query .= " ";
            }
        }


        return $query;
    }

    /**
     * @param $software
     * @param $nb
     * @return array
     */
    public function getListOfSameSoftwares($software, $nb) {
        $query = $this->getListTagsToString($software->getName());

        $result = $this->getAwesomeSearch()->search($query);


        return $result = array_slice($result, 1, $nb);
    }

    /**
     * @return mixed
     */
    public function getAwesomeSearch()
    {
        return $this->awesomeSearch;
    }

}