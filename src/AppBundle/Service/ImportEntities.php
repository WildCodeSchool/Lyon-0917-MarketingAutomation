<?php

namespace AppBundle\Service;

use AppBundle\Entity\SoftMain;
use AppBundle\Entity\Tag;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Yaml\Yaml;
use SplFileObject;


/*
 * Special service to import 3 CSV files, which can be find in  app/Resources/datas
 *
 * To import CSV, figure out service command "ImportCommand"
 *
 * 3 files for : softwares (description of each software + list of tags), list of tags, versus (software versus software)
 * manually set, with a description.
 *
 * Important : moulinette use DataBase map, describe in app/config/import.yml
 *
 * CSV file must match with fields and relationships. First row of header must be "Nom"
 *
 */

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

    }

    /*
     * Receive a file, give an object with parameters to read CSV file (delimiter is ",")
     */

    private function fileInit(string $fileFromConsole): \SplFileObject
    {


        $file = new \SplFileObject($fileFromConsole);


        $file->setFlags(
            SplFileObject::READ_CSV|
            SplFileObject::READ_AHEAD |
            SplFileObject::SKIP_EMPTY |
            SplFileObject::DROP_NEW_LINE
            );

        return $file;
    }


    /*
     * Verify match between expected data (here integer) and effective data, and return error if not matching
     */

    private function checkIfInteger(string $fileName, int $line, $value, int $column)
    {

        if (preg_match("#[0-9]# ", $value) === FALSE && $value != "") {
            array_push($this->errors, "Fichier " . $fileName . ": Line " . $line . " - Column" . $column . ": " . $value . " is expected to be an integer");
        }
    }


    /*
    * Verify correspondance between expected data (here boolean) and effective data, and return error if not matching
    */

    private function checkIfBool(string $fileName, int $line, $value, int $column)
    {

        if (is_bool($value) === FALSE) {
            if (isset($value)) {
                array_push($this->errors, "Fichier " . $fileName . ": Line " . $line . " - Column" . $column . ": " . $value . " is expected to be a boolean");
            }
        }

    }

    /*
    * To be display online, translate Booleans from true or false to "oui" or "non"
    */

    private function convertToBool(string $value)
    {

        $value = strtolower($value);

        if ($value === "oui") {
            return true;
        }
        if ($value === "non") {
            return false;
        }

        if ($value === "") {
            return null;

        } else {
            return $value;
        }
    }


    /*
    * Check if owner of files inconveniently duplicate data
    */

    public function searchForDuplicate(string $file, array $row)
    {

        switch ($file) {
            case "import-tags":
                $tag = $this->em->getRepository(Tag::class)
                    ->findOneBy([
                        'name' => $row[0],
                    ]);
                //        array_push($this->errors, "Tag: " . $tag . " is duplicate in file " . $file . ".csv.");
                break;

            case "import-softwares":
                $soft = $this->em->getRepository(SoftMain::class)
                    ->findOneBy([
                        'name' => $row[0],
                    ]);
                //  array_push($this->errors, "Tag: " . $soft . " is duplicate in file " . $file . ".csv.");
                break;

        }

    }


    /*
    *
    * Check if there are the same number of rows in the config file (import.yml) and in csv file.
    * If not, return an error in console
    *
    */
    public function verifCsv(string $softFile, string $fileName)
    {

        $softEntitiesYml = $this->getConfig()[$fileName]["entities"];
        $splSoftFile = $this->fileInit($softFile);

        while (!$splSoftFile->eof()) {

            $totalFields = 0;
            foreach ($softEntitiesYml as $softEntityYml) {
                $countField = count($softEntityYml["fields"]);
                $totalFields += $countField;
            }

            foreach ($splSoftFile as $rowFile) {

                if (count($rowFile) !== $totalFields) {
                    array_push($this->errors, "Nombre de colonne incorrect dans le fichier : " . $fileName . ".csv");

                } else {

                    $stillExists = $this->searchForDuplicate($fileName, $rowFile);
                    if (null === $stillExists) {

                        $line = 1;
                        foreach ($splSoftFile as $row) {


                            /*  foreach ($row as $data) {
                                  $convertedData[] = $this->convertToBool($data);
                              }*/

                            //définition des variables de la boucle:
                            $column = 0;

                            foreach ($softEntitiesYml as $entity) {
                                $testerror = $this->errors;

                                //parcourt les proprietés de chaque entity
                                foreach ($entity["fields"] as $property) {

                                    switch ($property) {

                                        case "list-tag":
                                            break;

                                        case "string":
                                            break;

                                        case "boolean":

                                            $this->checkIfBool($fileName, $line, $this->convertToBool($row[$column]), $column);
                                            break;

                                        case "integer":

                                            $this->checkIfInteger($fileName, $line, $row[$column], $column);
                                            break;

                                    }
                                    $column++;

                                }

                            }

                            $line++;

                        }
                    }

                }
            }
        }
    }

    /*
     *
     * Final import function : give location of file (not yet an object)
     * with type of topic (tag or software or versus),
     * after verifications
     *
     */

    public function import(string $softFile, string $type)
    {

        $softEntitiesYml = $this->getConfig()[$type]["entities"];
        $entityKeys = array_keys($softEntitiesYml);
        $splSoftFile = $this->fileInit($softFile);
        //$totalLines = $this->countLines($splSoftFile);

        while (!$splSoftFile->eof()) {
            foreach ($splSoftFile as $row) {
                //if line is empty, continue
                if (implode($row) == null) continue;
                // if line is ahead, go to next line
                if ($row[0] === $this->getConfig()[$type]["header"]) {
                //    $splSoftFile->next();
                } else {
                    $convertedData = [];
//                $stillExists = $this->searchForDuplicate($type, $row);
//                if (null === $stillExists) {

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

                            if ($property === "boolean") {
                                $convertedData[$caseImport] = $this->convertToBool($row[$caseImport]);
                            } elseif ($property === "integer") {
                                $convertedData[$caseImport] = (int)$row[$caseImport];
                            } else {
                                $convertedData[$caseImport] = $row[$caseImport];
                            }

                            if (count($property) === 3) {
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
                            } elseif ($property === "list-tag") {
                                $tags = explode("#", $convertedData[$caseImport]);
                                foreach ($tags as $tag) {
                                    $currentTag = $this->em->getRepository(Tag::class)->findOneBy(['name' => $tag,]);
                                    if (!empty($currentTag)) {
                                        $eachEntity[$i]->addTag($currentTag);
                                        $currentTag->addSoftMain($eachEntity[$i]);
                                        $this->em->persist($currentTag);
                                    }
                                }

                            } else {
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


    /*
     * Get errors to be display in console
     * See Console Command service in AppBundle/Command/ImportCommand.php
     */

    public
    function getErrors()
    {
        return $this->errors;
    }

    /*
     * Count lines and can be useful to set a progress bar.
     * Finally not use, but still here.
     */

    private
    function countLines(\SplFileObject $file)
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
    public
    function getConfig()
    {
        return $this->config;
    }

    /**
     *  // TODO : better explanation of this function
     * This function has to be implemented inside a transaction with a commit at the end
     * @param $connection
     */

    public
    function deleteAllContent(Connection $connection, $dbName)
    {
        $connection->query('SET FOREIGN_KEY_CHECKS=0');
        foreach ($this->getConfig()["table-names"] as $tableName) {
            $connection->query("DELETE FROM " . $dbName . "." . $tableName . ";");
            // Beware of ALTER TABLE here--it's another DDL statement and will cause
            // an implicit commit.

        }
        $connection->query('SET FOREIGN_KEY_CHECKS=1');
    }
}