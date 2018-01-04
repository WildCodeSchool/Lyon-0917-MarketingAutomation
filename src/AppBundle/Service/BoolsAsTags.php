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
        foreach ($this->getConfig()['Booleans'] as $entitie) {
            $i = 0;
            $booleanKeys = array_keys($entitie);
            foreach ($entitie as $entitieArray) {
                $number = $this->getNbSoftwaresByBool($booleanKeys[$i], $entityKeys[$j]);

                $result = array(
                    "slug" => trim($entitieArray['Slug']),
                    "entitie" => $entitieArray['Name'],
                    "number" => $number
                );
                $bools[] = $result;
                $i++;
            }
            $j++;
        }

        return $bools;
    }

    public function getNbSoftwaresByBool($bool, $entity): int
    {

        return count($this->em->getRepository(SoftMain::class)->getSoftByAnyBool($bool, $entity));
    }


    public function getListSoftwaresByEntitieSlug($slug): array
    {

        $softwares = [];
        $arrayResult = $this->getBoolAndEntityBySlug($slug);
        $softwares = $this->em->getRepository(SoftMain::class)->getSoftByAnyBool($arrayResult['bool'], $arrayResult['entitie']);

        return $softwares;
    }

    public function getBoolAndEntityBySlug($slug)
    {

        $result = [];
        $j = 0;
        $entityKeys = array_keys($this->getConfig()['Booleans']);
        foreach ($this->getConfig()['Booleans'] as $table) {
            $i = 0;
            $booleanKeys = array_keys($table);
            foreach ($table as $synonym) {
                if (stristr($synonym["Slug"], $slug) != FALSE) {
                    $result['bool'] = $booleanKeys[$i];
                    $result['entitie'] = $entityKeys[$j];
                }
                $i++;
            }
            $j++;
        }
        return $result;
    }

    public function getDescriptionBySlug($slug) {

        $j = 0;
        foreach ($this->getConfig()['Booleans'] as $table) {
            $i=0;
            foreach ($table as $synonym) {
                if (stristr($synonym["Slug"], $slug) != FALSE) {
                    $result = $synonym["Name"];
                }
                $i++;
            }
            $j++;
        }
        return $result;
    }

    /**
     * @return mixed
     */
    public function getConfig()
    {
        return $this->config;
    }


}