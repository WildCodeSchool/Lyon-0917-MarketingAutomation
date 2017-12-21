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
       $entityKeys = array_keys($this->getConfig()['Booleans']);
       $bools = [];
       $j = 0;
       foreach($this->getConfig()['Booleans'] as $entitie) {
            $i = 0;
           $booleanKeys = array_keys($entitie);
           foreach($entitie as $key=>$string){
               $arrayBool = explode(",", $string);
               foreach($arrayBool as $bool) {
                   $number = $this->getNbSoftwaresByBool($booleanKeys[$i], $entityKeys[$j]);
                   $bools[$bool] = $number;
               }
               $i++;
           }
        $j++;
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