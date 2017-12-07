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
        // Name and description for app/console command
        $this
            ->setName('import:csv')
            ->setDescription('Import entities from CSV file');
            //->addArgument('filetags', InputArgument::OPTIONAL, 'Chemin vers le fichier csv pour importer les tags?')
            //->addArgument('filesoft', InputArgument::OPTIONAL, 'Chemin vers le fichier csv pour importer les softwares?')
            //->addArgument('fileversus', InputArgument::OPTIONAL, 'Chemin vers le fichier csv pour importer les versus?');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $service = $this->getContainer()->get('app.import');
$connection = $this->em->getConnection();
        $connection->beginTransaction();
        $dbName = $this->getContainer()->getParameter("database_name");
        try {
            $service->deleteAllContent($connection, $dbName);
            $connection->commit();
        } catch (\Exception $e) {
            $this->em->getConnection()->rollBack();
            $output->writeln('Exception reçue : ' . $e->getMessage() . PHP_EOL);
        }


        // To do : Check if this is really csv in good format. If not, threw exception. Because we need 3 good csv to work.

        // To do : open transaction.
        //$this->getContainer()->

        // Here the foreach to hydrate entity Tags. Only one verification : if the name already exists.
        // To do : exclude header and verify data.


      //  $slugificator = $this->getContainer()->get('app.slug');



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