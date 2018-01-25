<?php

namespace AppBundle\Service;


use AppBundle\Entity\SoftMain;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Yaml\Yaml;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class BoolsAsTags :
 * This is a special service made for display booleans properties of softwares as tags, in listings tags and
 * in softwares page.
 *
 * @package AppBundle\Service
 */
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
     * @param EntityManagerInterface $em
     * @param $rootDir
     */
    public function __construct(EntityManagerInterface $em, $rootDir)
    {
        $this->em = $em;
        $this->config = Yaml::parse(file_get_contents($rootDir . "/config/awesomeSearch.yml"));

    }

    /**
     * @return array
     *
     * Return a list of booleans with explicit name, using awesomeSearch.yml informations.
     */

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

    /**
     * @param $bool
     * @param $entity
     * @return int
     *
     * Return number of softwares by boolean, where boolean is true
     *
     */
    public function getNbSoftwaresByBool($bool, $entity): int
    {

        return count($this->em->getRepository(SoftMain::class)->getSoftByAnyBool($bool, $entity));
    }


    /**
     * @param $slug
     * @return array
     *
     * Return list of softwares by boolean, where boolean is true
     *
     */
    public function getListSoftwaresByEntitieSlug($slug): array
    {

        $softwares = [];
        $arrayResult = $this->getBoolAndEntityBySlug($slug);
        $softwares = $this->em->getRepository(SoftMain::class)->getSoftByAnyBool($arrayResult['bool'], $arrayResult['entitie']);

        return $softwares;
    }

    /**
     * @param $slug
     * @return array
     *
     * Give a slug, return good name of bool and of his entity
     *
     */
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

    /**
     * @param $slug
     * @return mixed
     *
     * Return description, using awesomeSearch.yml, by slug
     *
     */
    public function getDescriptionBySlug($slug)
    {

        $j = 0;
        $result = [];
        foreach ($this->getConfig()['Booleans'] as $table) {
            $i = 0;
            foreach ($table as $synonym) {
                if (stristr($synonym["Slug"], $slug) != FALSE) {
                    $result["name"] = $synonym["Name"];
                    $result["description"] = $synonym["Description"];
                }
                $i++;
            }
            $j++;
        }
        return $result;
    }

    public function getBoolsBySoftware(SoftMain $softMain)
    {
        $entityKeys = array_keys($this->getConfig()['Booleans']);
        $bools = [];
        $j = 0;
        foreach ($this->getConfig()['Booleans'] as $entitie) {
            $i = 0;
            $booleanKeys = array_keys($entitie);
            foreach ($entitie as $entitieArray) {
                $requestResult = $this->em->getRepository(SoftMain::class)->getBoolByAnySoft($softMain->getName(), $booleanKeys[$i], $entityKeys[$j]);
                if (!empty($requestResult)) {

                    $result = array(
                        "slug" => trim($entitieArray['Slug']),
                        "entitie" => $entitieArray['Name'],
                    );
                    $bools[] = $result;
                }
                $i++;
            }
            $j++;
        }

        return $bools;
    }


    /**
     * @return mixed
     */
    public function getConfig()
    {
        return $this->config;
    }


}