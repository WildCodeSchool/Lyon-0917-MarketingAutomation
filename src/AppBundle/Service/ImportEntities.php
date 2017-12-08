<?php

namespace AppBundle\Service;

use AppBundle\AppBundle;
use AppBundle\Entity\SoftMain;
use AppBundle\Entity\Tag;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Yaml\Yaml;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

class ImportEntities
{


    /** @var ObjectManager */
    private $em;
    /**
     * @var Slugification
     */
    private $slugificator;
    /**
     * @var array
     */
    private $errors;
    /**
     * @var mixed
     */
    private $config;


    public function __construct(EntityManager $em, Slugification $slugificator, $rootDir)
    {
        $this->slugificator = $slugificator;
        $this->em = $em;
        $this->errors = array();
        $this->config = Yaml::parse(file_get_contents($rootDir . "/config/import.yml"));
        /*
                // D'abord on vérifie si ce qu'on reçoit est bien un fichier lisible, si c'est pas le cas, on envoie une exception
                if(!file_exists($fileFromConsole)) {
                    //TODO : améliorer ce truc
                    throw new \Exception("Ce n'est pas un fichier");
                }else{
                }
                 */
    }

    private function fileInit($fileFromConsole)
    {
        //by default delimiter is ","

        // Si c'est un fichier, on créé une nouvelle instance de SplFileObject
        $file = new \SplFileObject($fileFromConsole);

        // On définit les drapeaux : saute la ligne si elle est vide

        $file->setFlags(
            \SplFileObject::READ_CSV |
            \SplFileObject::READ_AHEAD |
            \SplFileObject::SKIP_EMPTY |
            \SplFileObject::DROP_NEW_LINE);

        return $file;
    }

    private function checkIfInteger($value, $column)
    {
        if (is_int($value) === FALSE) {
            array_push($this->errors, "Column" . $column . ": " . $value . "is expected to be an integer");
        }
    }

    private function checkIfBool($value, $column)
    {
        if ($value != "oui" || $value != "non") {
            if (isset($value)) {
                array_push($this->errors, "Column" . $column . ": " . $value . "is expected to be a boolean");
            }
        }

    }

// conversion des "oui" ou "non" ou "" par les booleens correspondants
    private function convertToBool($value)
    {
        if ($value === "oui") {
            return true;
        }
        if ($value === "non" || $value === "") {
            return false;
        } else {
            return $value;
        }
    }

    public function searchForDuplicate($file, array $row){

        switch($file)

        {
            case "import-tags":
                $tag = $this->em->getRepository(Tag::class)
                    ->findOneBy([
                        'name' => $row[0],
                    ]);
                return $tag;
                break;

            case "import-softwares":
                $soft = $this->em->getRepository(SoftMain::class)
                    ->findOneBy([
                        'name' => $row[0],
                    ]);
                return $soft;
                break;

        }


    }

    // Ready for softwares and versus files

    public function import($softFile, $type)
    {
        $softEntitiesYml = $this->getConfig()[$type]["entities"];
        $entityKeys = array_keys($softEntitiesYml);
        $splSoftFile = $this->fileInit($softFile);
        //$totalLines = $this->countLines($splSoftFile);

        while (!$splSoftFile->eof()) {
            foreach ($splSoftFile as $row) {
                $convertedData = [];
                $stillExists = $this->searchForDuplicate($type, $row);
                if (null === $stillExists) {
                    foreach($row as $data) {
                        $convertedData[] = $this->convertToBool($data);
                    }

                    //définition des variables de la boucle:
                    $caseImport = 0;
                    $i = 0;
                    $j = 0;
                    $eachEntity = [];

                    //parcourt chaque entité pour ajouter les valeurs
                    foreach ($softEntitiesYml as $entity) {
                        $myClass = "AppBundle\\Entity\\" . $entityKeys[$i];
                        $eachEntity[$i] = new $myClass();
                        $listFields = array_keys($entity["fields"]);


                        //parcourt les proprietés de chaque entity
                        foreach ($entity["fields"] as $property) {

                            if(count($property) === 3){
                                $soft = $this->em->getRepository(SoftMain::class)
                                    ->findOneBy([
                                        'name' => $convertedData[$caseImport],
                                    ]);
                                if (!empty($soft)) {
                                    $set = "set" . ucfirst($listFields[$j]);
                                    $eachEntity[$i]->$set($soft);
                                    $add = "add" . ucfirst($property["inversedby"]);
                                    $soft->$add($eachEntity[$i]);
                                    $this->em->persist($soft);
                                }

                            }else {
                                $eachSetter = "set" . ucfirst($listFields[$j]);
                                $eachEntity[$i]->$eachSetter($convertedData[$caseImport]);
                            }
                            $j++;
                            $caseImport++;
                        }
                        $j = 0;
                        $i++;
                    }
                    //csv reading end
                    // add Links for each entities
                    $k = 0;
                    $slug = $this->slugificator->slugFactory($row[0]);

                    foreach ($softEntitiesYml as $entity) {

                        //ATTENTION: Rajouter une boucle si les entités ont plusieurs links et plusieurs sources

                        if ($entity["links"]["relation"] === "Many-to-Many") {
                            $eachSetterLink = "add" . $entityKeys[$k];
                            $eachSource = "AppBundle\\Entity\\" . $entity["links"]["source"];
                            $eachSource->$eachSetterLink($eachEntity[$k]);
                        }
                        //upgrade: $eachEntity[0] can be change by an automatic
                        if ($entity["links"]["relation"] === "One-to-One") {
                            $eachSetterLink = "set" . $entityKeys[$k];
                            $eachEntity[0]->$eachSetterLink($eachEntity[$k]);
                        }

                        if ($entity["slugExceptions"]["slug"] === "yes") {
                            $mySlugSetter = "setSlug";

                            $eachEntity[0]->$mySlugSetter("$slug");
                        }
                        if ($entity["slugExceptions"]["logo"] === "yes") {
                            $mySlugLogoUrlSetter = "setLogoUrl";
                            $eachEntity[0]->$mySlugLogoUrlSetter("assets/img/logo/" . $slug . ".png");
                        }
                        $k++;
                    }
                    // persist for each entities

                    foreach ($eachEntity as $finalEntity) {
                        $this->em->persist($finalEntity);
                    }

                    $this->em->flush();

                }

            }
        }

    }



    public function getErrors()
    {
        return $this->errors;
    }



    private function countLines(\SplFileObject $file)
    {

        // On va à la fin max du fichier
        $file->seek(PHP_INT_MAX);

        // On récupère le nombre de lignes et on hydrate la propriété avec
        $totalLines = $file->key() + 1;

        // On remonte le pointeur au début du fichier
        $file->seek(0);

        return $totalLines;
    }

    /**
     * @return mixed
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param $connection
     */
    //This function has to be implemented inside a transaction with a commit at the end
    public function deleteAllContent(Connection $connection, $dbName)
    {
        $connection->query('SET FOREIGN_KEY_CHECKS=0');
        foreach ($this->getConfig()["table-names"] as $tableName) {
            $connection->query("DELETE FROM " . $dbName ."." . $tableName . ";");
            // Beware of ALTER TABLE here--it's another DDL statement and will cause
            // an implicit commit.

        }
        $connection->query('SET FOREIGN_KEY_CHECKS=1');
    }
}