<?php

namespace AppBundle\Command;


use AppBundle\AppBundle;
use AppBundle\Entity\Tag;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\ProgressBar;
use AppBundle\Service\ImportEntities;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputArgument;

class ImportCommand extends ContainerAwareCommand

//chercher comment utiliser le service (get container)
{

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct();
        $this->em = $em;
    }

    protected function configure()
    {
        // Name and description for app/console command
        $this
            ->setName('import:csv')
            ->setDescription('Import entities from CSV file')
            ->addArgument('filetags', InputArgument::REQUIRED, 'Chemin vers le fichier csv pour importer les tags?')
            ->addArgument('filesoft', InputArgument::OPTIONAL, 'Chemin vers le fichier csv pour importer les softwares?')
            ->addArgument('fileversus', InputArgument::OPTIONAL, 'Chemin vers le fichier csv pour importer les versus?');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        // Here, we need to get Input Argument. We have to catch 3 arguments.
        $inputFileTags = $input->getArgument('filetags');

        // To do : Check if this is really csv in good format. If not, threw exception. Because we need 3 good csv to work.

        // If file is okay : transform in splFileObject
        $fileTags = new \SplFileObject($inputFileTags);
        // Ready to be read and skip empty row
        $fileTags->setFlags(\SplFileObject::READ_CSV | \SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);

        // To do : open transaction.


        // Here the foreach to hydrate entity Tags. Only one verification : if the name already exists.
        // To do : exclude header and verify data.

        while (!$fileTags->eof()) {
            foreach ($fileTags as $row) {
                list($name, $description) = $row;
                $tag = $this->em->getRepository(Tag::class)
                    ->findOneBy([
                        'name' => $name,
                    ]);
                if(null === $tag) {
                    $tag = new Tag();
                    $tag->setName($name);
                    $tag->setDescription($description);
                    $this->em->persist($tag);
                    $this->em->flush();
                }

            }
        }

        // End of transaction and commit if already went good.


        //encapsuler le code dans un try pour récupérer l'erreur, si elle ne vient pas de nous (c'est à dire du fichier)
        //Donc il faut prévoir de récupérer l'erreur qui est hors du code et prévoir le rollback

        // Showing when the script is launched
        $now = new \DateTime();

        $output->writeln('<comment>Start : ' . $now->format('d-m-Y G:i:s') . ' ---</comment>');


        // Showing when the script is over
        $now = new \DateTime();
        $output->writeln('<comment>End : ' . $now->format('d-m-Y G:i:s') . ' ---</comment>');
    }

}