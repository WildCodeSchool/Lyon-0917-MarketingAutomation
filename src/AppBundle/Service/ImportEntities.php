<?php

namespace AppBundle\Service;

use AppBundle\Entity\Tag;
use Doctrine\Common\Persistence\ObjectManager;

class ImportEntities
{
// Première version : on hydrate nos objets manuellement
// Voir une v2 où on pourrait créer les entités à la volée, ce qui permettrait une meilleure maintenance du système et la possibilité de maintenir la base (MAJ des colonnes, par exemple)

    /** @var ObjectManager */
    private $em;
    private $slugificator;
    private $errors;

    public function __construct(ObjectManager $em, Slugification $slugificator)
    {
        $this->slugificator = $slugificator;
        $this->em = $em;
        $this->errors = array();
        /*
                // D'abord on vérifie si ce qu'on reçoit est bien un fichier lisible, si c'est pas le cas, on envoie une exception
                if(!file_exists($fileFromConsole)) {
                    //TODO : améliorer ce truc
                    throw new \Exception("Ce n'est pas un fichier");
                }else{



                }
                 */
    }

    private function checkIfString()
    {
        //Check if data is string, if it's not, return error
        // But I don't know if it's really efficient (utf8?)
        // Vérifier que le texte n'est pas "oui" ou "non"
    }

    private function checkIfInteger($value, $column)
    {
        if (is_int($value) === FALSE) {
            array_push($this->errors, "Column" . $column . ": " . $value . "is expected to be an integer");
        }
    }

    //si c'est différent de oui ou non, mais que c'est quand meme set ->error)
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
        switch ($value) {
            case "oui":
                return $value = TRUE;
                break;
            case "non":
                return $value = FALSE;
                break;
            case (!isset($value)):
                return $value = FALSE;
                break;
        }
    }


    public function importTags($fileTags)
    {
        // A tester sans le while
        $splFileTags = $this->fileInit($fileTags);
        $totalLines = $this->countLines($splFileTags);
        while (!$splFileTags->eof()) {
            foreach ($splFileTags as $row) {

                list($name, $description, $softwares) = $row;
                $tag = $this->em->getRepository(Tag::class)
                    ->findOneBy([
                        'name' => $name,
                    ]);
                if (null === $tag) {
                    $tag = new Tag();
                    $tag->setName($name);
                    $tag->setDescription($description);
                    $softArray = explode("#",$softwares);
                    foreach ($softArray as $soft)
                    {

                        $tag->addSoftMain($soft);
                    }
                    $slug = $this->slugificator->slugFactory($name);
                    $tag->setSlug($slug);
                    $this->em->persist($tag);
                    $this->em->flush();
                }

            }
        }
    }

    public function importSoftware($softFile)
    {


    }

    public function importVersus($data)
    {
        $this->fileInit($data);
        // From csv, check if data is correct, if is not, return error

    }

    public function getErrors()
    {
        return $this->errors;
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

    private function splitString($string)
    {
        // transform string to array with ";" delimiters
        $array = preg_split("/[#]+/", $string);
        return $array;

    }

}