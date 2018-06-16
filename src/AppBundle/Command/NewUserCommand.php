<?php

namespace AppBundle\Command;

use AppBundle\Entity\User;
use AppBundle\Service\UserOperationService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class NewUserCommand
 * Useful to create a new user by command line
 * @package AppBundle\Command
 */
class NewUserCommand extends ContainerAwareCommand
{

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var UserOperationService
     */
    private $userOperationService;


    /**
     * NewUserCommand constructor.
     * @param EntityManagerInterface $em
     * @param UserOperationService $userOperationService
     */
    public function __construct(EntityManagerInterface $em, UserOperationService $userOperationService)
    {
        parent::__construct();

        $this->em = $em;
        $this->userOperationService = $userOperationService;
    }

    protected function configure()
    {
        /**
         * Example : app:create-user username username@mail.fr password
         */
        $this
            ->addArgument('username', InputArgument::REQUIRED, 'What is your username ?')
            ->addArgument('email', InputArgument::REQUIRED, 'What is your email ?')
            ->addArgument('password', InputArgument::OPTIONAL, 'what is your password ?')
            // the name of the command (the part after "bin/console")
            ->setName('app:create-user')

            // the short description shown while running "php bin/console list"
            ->setDescription('Creates a new user.')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command allows you to create a user...');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $username = $input->getArgument('username');
        $email = $input->getArgument('email');
        $password = $input->getArgument('password');

        try {
            $user = new User();
            $user->setUsername($username);
            $user->setEmail($email);
            $user = $this->userOperationService->makeAPassword($user, $password);
            $this->em->persist($user);
            $this->em->flush();

            // outputs a message without adding a "\n" at the end of the line
            $output->write('Well done, ');
            $output->write('user is created.');
        } catch (Exception $e) {
            $output->write('Oops, something wrong' . $e->getMessage());
        }

    }

}