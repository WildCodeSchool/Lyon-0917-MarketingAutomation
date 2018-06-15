<?php

namespace AppBundle\Controller;

use AppBundle\Entity\SoftMain;
use AppBundle\Entity\SoftSeeAlso;
use AppBundle\Entity\Tag;
use AppBundle\Entity\User;
use AppBundle\Service\BoolsAsTags;
use AppBundle\Service\FileUploader;
use AppBundle\Service\SeeAlso;
use AppBundle\Service\Slugification;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class AdminController
 * @package AppBundle\Controller
 */
class AdminController extends BaseAdminController
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;
    /**
     * @var BoolsAsTags
     */
    private $boolsAsTags;
    /**
     * @var SeeAlso
     */
    private $seeAlso;
    /**
     * @var Slugification
     */
    private $slugification;
    /**
     * @var FileUploader
     */
    private $fileuploader;

    /**
     * AdminController constructor.
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param BoolsAsTags $boolsAsTags
     * @param SeeAlso $seeAlso
     * @param Slugification $slugification
     * @param FileUploader $fileuploader
     */
    public function __construct(
        UserPasswordEncoderInterface $passwordEncoder,
        BoolsAsTags $boolsAsTags,
        SeeAlso $seeAlso,
        Slugification $slugification,
        FileUploader $fileuploader
    )
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->boolsAsTags = $boolsAsTags;
        $this->seeAlso = $seeAlso;
        $this->slugification = $slugification;
        $this->fileuploader = $fileuploader;
    }

    /**
     * @param object $entity
     */
    protected function prePersistEntity($entity)
    {

        if ($entity instanceof User)
        {
            $this->makeAPassword($entity);

        }

        if ($entity instanceof Tag) {
            $slug = $this->slugification->slugFactory($entity->getName());
            $entity->setSlug($slug);

            if ($entity->getSoftMains() !== null) {
                foreach ($entity->getSoftMains() as $softMain) {
                    $softMain->addTag($entity);
                }
            }

        }

        if ($entity instanceof SoftMain) {
            /**
             * Create new SoftSeeAlso entity and set arrays
             */
            $softSeeAlso = new SoftSeeAlso();
            $entity->setSoftSeeAlso($softSeeAlso);
            $listSeeAlso = $this->seeAlso->getListOfSameSoftwares($entity, 6);
            $bools = $this->boolsAsTags->getBoolsBySoftware($entity);
            $softSeeAlso->setBooleans($bools);
            $softSeeAlso->setSoftSeeAlsoArray($listSeeAlso);

            /**
             * Create slug and logo
             */
            $slug = $this->slugification->slugFactory($entity->getName());
            $entity->setLogoUrl("assets/img/logo/" . $slug . ".png");
            $entity->setSlug($slug);

            /**
             * Store logo
             */
            if (!empty($entity->getLogo()))
            {
                $file = $entity->getLogo();
                $fileName = $this->fileuploader->upload($file, $slug);
                $entity->setLogo($fileName);
            }

        }

        return parent::prePersistEntity($entity);
    }

    /**
     * @param object $entity
     */
    protected function preUpdateEntity($entity)
    {

        if ($entity instanceof User)
        {
            $this->makeAPassword($entity);
        }

        /**
         * Manage add new softMains to collection
         */
        if ($entity instanceof Tag) {
            if ($entity->getSoftMains() !== null)
                foreach ($entity->getSoftMains() as $softMain) {
                    if (!$softMain->getTags()->contains($entity)) {
                        $softMain->addTag($entity);
                    }
                }
        }

        /**
         * Update booleans list, if there are new particularities
         */
        if ($entity instanceof SoftMain)
        {
            $bools = $this->boolsAsTags->getBoolsBySoftware($entity);
            $entity->getSoftSeeAlso()->setBooleans($bools);

        }
        return parent::preUpdateEntity($entity);

    }

    /**
     * @param User $user
     * @return User
     */
    protected function makeAPassword(User $user)
    {
        $password = $this->passwordEncoder->encodePassword($user, $user->getPlainPassword());
        $user->setPassword($password);
        return $user;
    }
}