<?php

namespace AppBundle\Command;



use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
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
        $this
            ->setName('import:csv')
            ->setDescription('Import entities from CSV file')
            ->addArgument('filetags', InputArgument::OPTIONAL, 'Chemin vers le fichier csv pour importer les tags?')
            ->addArgument('filesoft', InputArgument::OPTIONAL, 'Chemin vers le fichier csv pour importer les softwares?')
            ->addArgument('fileversus', InputArgument::OPTIONAL, 'Chemin vers le fichier csv pour importer les versus?');
        // Name and description for app/console command
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $service = $this->getContainer()->get('app.import');

        $fileSoft = $input->getArgument('filesoft');
        //$fileSoftFromDir = '%root_dir%/Resources/data/import-softwares.csv';
        if(file_exists($fileSoft)){
            $type  = "import-softwares";
            $service->import($fileSoft, $type);
        }else{
            return "not working";
        }

        $fileTag = $input->getArgument('filetags');
        //$fileSoftFromDir = '%root_dir%/Resources/data/import-softwares.csv';
        if(file_exists($fileTag)){
            $type  = "import-tags";
            $service->import($fileTag, $type);
        }else{
            return "not working";
        }

        $fileVersus = $input->getArgument('fileversus');
        //$fileSoftFromDir = '%root_dir%/Resources/data/import-softwares.csv';
        if(file_exists($fileVersus)){
            $type  = "import-versus";
            $service->import($fileVersus, $type);
        }else{
            return "not working";
        }

        // Showing when the script is launched
        $now = new \DateTime();

        $output->writeln('<comment>Start : ' . $now->format('d-m-Y G:i:s') . ' ---</comment>');


        // Showing when the script is over
        $now = new \DateTime();
        $output->writeln('<comment>End : ' . $now->format('d-m-Y G:i:s') . ' ---</comment>');

    }

}