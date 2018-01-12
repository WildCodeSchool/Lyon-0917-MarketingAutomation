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
     * @ORM\OneToOne(targetEntity="SoftMain", mappedBy="softOtherFunctionnalities")
     * @ORM\JoinColumn(name="softMainId", referencedColumnName="id", onDelete="CASCADE")
     */
    private $softMain;


    /**
     * Get id
     *
     * @return integer
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
     * @return boolean
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
     * @return boolean
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
     * @return boolean
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
     * @return boolean
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
     * @return boolean
     */
    public function getIsRssToEmail()
    {
        return $this->isRssToEmail;
    }

    /**
     * Set softMain
     *
     * @param \AppBundle\Entity\SoftMain $softMain
     *
     * @return SoftOtherFunctionnalities
     */
    public function setSoftMain(\AppBundle\Entity\SoftMain $softMain = null)
    {
        $this->softMain = $softMain;

        return $this;
    }

    /**
     * Get softMain
     *
     * @return \AppBundle\Entity\SoftMain
     */
    public function getSoftMain()
    {
        return $this->softMain;
    }
}
