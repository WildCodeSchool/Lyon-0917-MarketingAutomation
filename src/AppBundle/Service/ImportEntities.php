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
    /** @var \SplFileObject  */
    private $file;
    private $totalLines;

    public function __construct(ObjectManager $em, $fileFromConsole)
    {
        $this->em = $em;

        // D'abord on vérifie si ce qu'on reçoit est bien un fichier lisible, si c'est pas le cas, on envoie une exception
        if(!file_exists($fileFromConsole)) {
            //TODO : améliorer ce truc
            throw new \Exception("Ce n'est pas un fichier");
        }else{

            // Si c'est un fichier, on créé une nouvelle instance de SplFileObject
        $this->file = new \SplFileObject($fileFromConsole);

        // On définit les drapeaux : saute la ligne si elle est vide
        $this->file->setFlags(\SplFileObject::READ_AHEAD |
            \SplFileObject::SKIP_EMPTY |
            \SplFileObject::DROP_NEW_LINE);

        // On va à la fin max du fichier
        $this->file->seek(PHP_INT_MAX);

        // On récupère le nombre de lignes et on hydrate la propriété avec
        $this->totalLines = $this->file->key() + 1;

        // On remonte le pointeur au début du fichier
        $this->file->seek(0);
        }
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