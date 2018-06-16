<?php

namespace AppBundle\Service;


use AppBundle\Entity\User;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserOperationService
{
    /**
     * @var PasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * UserOperationService constructor.
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @param User $user
     * @param $password
     * @return User
     */
    public function makeAPassword(User $user, $password)
    {
        $password = $this->passwordEncoder->encodePassword($user, $password);
        $user->setPassword($password);
        return $user;
    }

}