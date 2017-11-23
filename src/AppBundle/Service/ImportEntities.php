<?php

namespace AppBundle\Service;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportEntities
{
// Première version : on hydrate nos objets manuellement
// Voir une v2 où on pourrait créer les entités à la volée, ce qui permettrait une meilleure maintenance du système et la possibilité de maintenir la base (MAJ des colonnes, par exemple)

    /** @var ObjectManager  */
    private $em;

    public function __construct(ObjectManager $em)
    {
        $this->em = $em;
    }

    public function get(InputInterface $input, OutputInterface $output)
    {
        // Getting the CSV from console command
        return $data;
    }


    public function convert($filename, $delimiter = ',')
        //Convert file to be readable
        // voir les fonctions en SPLfileobject (bibliothèque php hyper rapide) pour savoir combien de lignes traiter (cf barre progression)
    {
        if(!file_exists($filename) || !is_readable($filename)) {
            return FALSE;
        }

        $header = NULL;
        $data = array();

        if (($handle = fopen($filename, 'r')) !== FALSE) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE) {
                if(!$header) {
                    $header = $row;
                } else {
                    $data[] = array_combine($header, $row);
                }
            }
            fclose($handle);
        }
        return $data;
    }

    public function checkIfString()
    {
        //Check if data is string, if it's not, return error
        // But I don't know if it's really efficient (utf8?)
    }

    public function checkIfInteger()
    {
        //Check if data is integer, if it's not, return error
    }

    public function checkIfBool()
    {
        //Check if data is oui or non or null (if empty), if it's not, return error
    }


    public function importTags($data)
    {
        // From csv, check if data is correct, if is not, return error

        // Getting php array of data from CSV with method get (to do)
        $data = $this->get($input, $output);
    }

    public function importSoftware($data)
    {
        // From csv, check if data is correct, if is not, return error

    }

    public function importVersus($data)
    {
        // From csv, check if data is correct, if is not, return error

    }

    public function import{


    }
}