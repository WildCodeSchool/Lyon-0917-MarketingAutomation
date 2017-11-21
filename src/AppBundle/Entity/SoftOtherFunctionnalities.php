<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SoftOtherFunctionnalities
 *
 * @ORM\Table(name="soft_other_functionnalities")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SoftOtherFunctionnalitiesRepository")
 */
class SoftOtherFunctionnalities
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var bool
     *
     * @ORM\Column(name="isProviderEmailChoice", type="boolean", nullable=true)
     */
    private $isProviderEmailChoice;

    /**
     * @var bool
     *
     * @ORM\Column(name="isBlogEdition", type="boolean", nullable=true)
     */
    private $isBlogEdition;

    /**
     * @var bool
     *
     * @ORM\Column(name="isTouchPad", type="boolean", nullable=true)
     */
    private $isTouchPad;

    /**
     * @var bool
     *
     * @ORM\Column(name="isSmtpRelay", type="boolean", nullable=true)
     */
    private $isSmtpRelay;

    /**
     * @var bool
     *
     * @ORM\Column(name="isRssToEmail", type="boolean", nullable=true)
     */
    private $isRssToEmail;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set isProviderEmailChoice
     *
     * @param boolean $isProviderEmailChoice
     *
     * @return SoftOtherFunctionnalities
     */
    public function setIsProviderEmailChoice($isProviderEmailChoice)
    {
        $this->isProviderEmailChoice = $isProviderEmailChoice;

        return $this;
    }

    /**
     * Get isProviderEmailChoice
     *
     * @return bool
     */
    public function getIsProviderEmailChoice()
    {
        return $this->isProviderEmailChoice;
    }

    /**
     * Set isBlogEdition
     *
     * @param boolean $isBlogEdition
     *
     * @return SoftOtherFunctionnalities
     */
    public function setIsBlogEdition($isBlogEdition)
    {
        $this->isBlogEdition = $isBlogEdition;

        return $this;
    }

    /**
     * Get isBlogEdition
     *
     * @return bool
     */
    public function getIsBlogEdition()
    {
        return $this->isBlogEdition;
    }

    /**
     * Set isTouchPad
     *
     * @param boolean $isTouchPad
     *
     * @return SoftOtherFunctionnalities
     */
    public function setIsTouchPad($isTouchPad)
    {
        $this->isTouchPad = $isTouchPad;

        return $this;
    }

    /**
     * Get isTouchPad
     *
     * @return bool
     */
    public function getIsTouchPad()
    {
        return $this->isTouchPad;
    }

    /**
     * Set isSmtpRelay
     *
     * @param boolean $isSmtpRelay
     *
     * @return SoftOtherFunctionnalities
     */
    public function setIsSmtpRelay($isSmtpRelay)
    {
        $this->isSmtpRelay = $isSmtpRelay;

        return $this;
    }

    /**
     * Get isSmtpRelay
     *
     * @return bool
     */
    public function getIsSmtpRelay()
    {
        return $this->isSmtpRelay;
    }

    /**
     * Set isRssToEmail
     *
     * @param boolean $isRssToEmail
     *
     * @return SoftOtherFunctionnalities
     */
    public function setIsRssToEmail($isRssToEmail)
    {
        $this->isRssToEmail = $isRssToEmail;

        return $this;
    }

    /**
     * Get isRssToEmail
     *
     * @return bool
     */
    public function getIsRssToEmail()
    {
        return $this->isRssToEmail;
    }
}

