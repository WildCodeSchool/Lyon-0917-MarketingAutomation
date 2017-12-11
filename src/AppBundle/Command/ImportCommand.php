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

            ->addArgument('filetags', InputArgument::OPTIONAL, 'Chemin vers le fichier csv pour importer les tags?')

            ->addArgument('filesoft', InputArgument::OPTIONAL, 'Chemin vers le fichier csv pour importer les softwares?')

            ->addArgument('fileversus', InputArgument::OPTIONAL, 'Chemin vers le fichier csv pour importer les versus?');
        // Name and description for app/console command
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $serviceImport = $this->getContainer()->get('app.import');
        $fileSoft = $input->getArgument('filesoft');
        $fileTag = $input->getArgument('filetags');
        $fileVersus = $input->getArgument('fileversus');
        $connection = $this->em->getConnection();
        $dbName = $this->getContainer()->getParameter("database_name");

        if (file_exists($fileTag)) {
            $type = "import-tags";
            $serviceImport->verifCsv($fileTag, $type);
        } else {
            $output->writeln("Fichier import-tags.csv manquant");

        }
      
        // To do : Check if this is really csv in good format. If not, threw exception. Because we need 3 good csv to work.
        if (file_exists($fileSoft)) {
            $type = "import-softwares";
            $serviceImport->verifCsv($fileSoft, $type);
        } else {
            $output->writeln("Fichier import-softwares.csv manquant");
        }


        if (file_exists($fileVersus)) {
            $type = "import-versus";
            $serviceImport->verifCsv($fileVersus, $type);
        } else {
            $output->writeln("Fichier import-versus.csv manquant");
        }

        $errors = $serviceImport->getErrors();
        if (count($errors) > 0) {
            foreach ($errors as $error) {
                $output->writeln($error);
            }

        } else {
          
        //encapsuler le code dans un try pour récupérer l'erreur, si elle ne vient pas de nous (c'est à dire du fichier)

         
            $connection->beginTransaction();


            try {
                $serviceImport->deleteAllContent($connection, $dbName);

                $serviceImport->import($fileTag, "import-tags");

                $serviceImport->import($fileSoft, "import-softwares");

                $serviceImport->import($fileVersus, "import-versus");
              
                // End of transaction and commit if already went good.

                $connection->commit();

                $output->writeln("La BDD a bien été importée." . PHP_EOL);

            } catch (\Exception $e) {
              
                $connection->rollBack();

                $output->writeln('Exception reçue : ' . $e->getMessage() . PHP_EOL);
            }

        }

    }

}
