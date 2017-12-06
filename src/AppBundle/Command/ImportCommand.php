<?php

namespace AppBundle\Command;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


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
            ->addArgument('filesoft', InputArgument::OPTIONAL, 'Chemin vers le fichier csv pour importer les softwares?')
            ->addArgument('filetags', InputArgument::OPTIONAL, 'Chemin vers le fichier csv pour importer les tags?')
            ->addArgument('fileversus', InputArgument::OPTIONAL, 'Chemin vers le fichier csv pour importer les versus?');
        // Name and description for app/console command
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $service = $this->getContainer()->get('app.import');


        $fileSoft = $input->getArgument('filesoft');
        $fileTag = $input->getArgument('filetags');
        $fileVersus = $input->getArgument('fileversus');


        if (file_exists($fileSoft)) {
            $type = "import-softwares";
            $service->verifCsv($fileSoft, $type);
        } else {
            $output->writeln("Fichier import-softwares.csv manquant");
        }

        //$fileSoftFromDir = '%root_dir%/Resources/data/import-softwares.csv';
        if (file_exists($fileTag)) {
            $type = "import-tags";
            $service->verifCsv($fileTag, $type);
        } else {
            $output->writeln("Fichier import-tags.csv manquant");
        }


        //$fileSoftFromDir = '%root_dir%/Resources/data/import-softwares.csv';
        if (file_exists($fileVersus)) {
            $type = "import-versus";
            $service->verifCsv($fileVersus, $type);
        } else {
            $output->writeln("Fichier import-versus.csv manquant");
        }

        $errors = $service->getErrors();
        if (count($errors) > 0) {
            foreach ($errors as $error) {
                $output->writeln($error);
            }

        } else {

            $this->em->getConnection()->beginTransaction();

            try {

                //$fileSoftFromDir = '%root_dir%/Resources/data/import-softwares.csv';
                if (file_exists($fileSoft)) {
                    $type = "import-softwares";
                    $service->import($fileSoft, $type);
                } else {
                    return "not working";
                }

                //$fileSoftFromDir = '%root_dir%/Resources/data/import-softwares.csv';
                if (file_exists($fileTag)) {
                    $type = "import-tags";
                    $service->import($fileTag, $type);
                } else {
                    return "not working";
                }

                //$fileSoftFromDir = '%root_dir%/Resources/data/import-softwares.csv';
                if (file_exists($fileVersus)) {
                    $type = "import-versus";
                    $service->import($fileVersus, $type);
                } else {
                    return "not working";
                }

                $this->em->getConnection()->commit();

            } catch (\Exception $e) {

                $this->em->getConnection()->rollBack();

                $output->writeln('Exception reçue : ' . $e->getMessage() . PHP_EOL);
            }

        }


        // Showing when the script is launched
        $now = new \DateTime();

        $output->writeln('<comment>Start : ' . $now->format('d-m-Y G:i:s') . ' ---</comment>');


        // Showing when the script is over
        $now = new \DateTime();
        $output->writeln('<comment>End : ' . $now->format('d-m-Y G:i:s') . ' ---</comment>');

    }

}
