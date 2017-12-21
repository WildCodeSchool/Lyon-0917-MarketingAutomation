<?php

namespace AppBundle\Service;


use Doctrine\ORM\EntityManager;
use Symfony\Component\Yaml\Yaml;
use Doctrine\Common\Persistence\ObjectManager;


class BoolsAsTags
{
    /** @var ObjectManager */
    private $em;
    /**
     * @var mixed
     */
    private $config;

    /**
     * BoolsAsTags constructor.
     * @param EntityManager $em
     * @param $rootDir
     */
    public function __construct(EntityManager $em, $rootDir)
    {
        $this->em = $em;
        $this->config = Yaml::parse(file_get_contents($rootDir . "/config/awesomeSearch.yml"));

    }

    public function getGoodBools()
   {
       $entities = $this->getConfig()["Booleans"];
       $bools = [];
       foreach($entities as $entitie) {

           foreach($entitie as $key=>$string){
               $arrayBool = explode(",", $string);
               foreach($arrayBool as $bool) {
                   $bools[] = $bool;
               }
           }

       }

       return $bools;
   }

   public function getNbSoftwaresByBool($bool){


}

    /**
     * @return mixed
     */
    public function getConfig()
    {
        return $this->config;
    }


}