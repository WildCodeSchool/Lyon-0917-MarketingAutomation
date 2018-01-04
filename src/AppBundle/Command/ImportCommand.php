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
            ->setName('import:database')
            ->setDescription('Import entities from CSV file');

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $serviceImport = $this->getContainer()->get('AppBundle\Service\ImportEntities');
        $pathSoft = "app/Resources/datas/import-softwares.csv";
        $pathTags = "app/Resources/datas/import-tags.csv";
        $pathVersus = "app/Resources/datas/import-versus.csv";

        $connection = $this->em->getConnection();
        $dbName = $this->getContainer()->getParameter("database_name");

        if (file_exists($pathTags)) {
            $type = "import-tags";
            $serviceImport->verifCsv($pathTags, $type);
        } else {
            $output->writeln("Fichier import-tags.csv manquant");

        }
      
        // To do : Check if this is really csv in good format. If not, threw exception. Because we need 3 good csv to work.
        if (file_exists($pathSoft)) {
            $type = "import-softwares";
            $serviceImport->verifCsv($pathSoft, $type);
        } else {
            $output->writeln("Fichier import-softwares.csv manquant");
        }


        if (file_exists($pathVersus)) {
            $type = "import-versus";
            $serviceImport->verifCsv($pathVersus, $type);
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

                $serviceImport->import($pathTags, "import-tags");

                $serviceImport->import($pathSoft, "import-softwares");

                $serviceImport->import($pathVersus, "import-versus");
              
                // End of transaction and commit if already went good.

                $connection->commit();

                $output->writeln("La BDD a bien été importée." . PHP_EOL . '
____    __    ____  _______  __       __          _______   ______   .__   __.  _______     __  
\   \  /  \  /   / |   ____||  |     |  |        |       \ /  __  \  |  \ |  | |   ____|   |  | 
 \   \/    \/   /  |  |__   |  |     |  |        |  .--.  |  |  |  | |   \|  | |  |__      |  | 
  \            /   |   __|  |  |     |  |        |  |  |  |  |  |  | |  . `  | |   __|     |  | 
   \    /\    /    |  |____ |  `----.|  `----.   |  \'--\'  |  `--\'  | |  |\   | |  |____    |__| 
    \__/  \__/     |_______||_______||_______|   |_______/ \______/  |__| \__| |_______|   (__) 
                                                                                                
            
            ');


            } catch (\Exception $e) {
              
                $connection->rollBack();

                $output->writeln('Exception reçue : ' . $e->getMessage() . PHP_EOL);
            }

        }

    }

}
