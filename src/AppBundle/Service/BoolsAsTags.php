<?php

namespace AppBundle\Service;


use AppBundle\Entity\SoftMain;
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
                   $number = $this->getNbSoftwaresByBool($key, $entitie);
                   $bools[$bool] = $number;
               }
           }

       }

       return $bools;
   }

   public function getNbSoftwaresByBool($bool, $entity) : int{

       return count($this->em->getRepository(SoftMain::class)->getSoftByAnyBool($bool, $entity));
    }

    /**
     * @return mixed
     */
    public function getConfig()
    {
        return $this->config;
    }


}