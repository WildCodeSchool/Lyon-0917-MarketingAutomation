<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SoftSocialMedia
 *
 * @ORM\Table(name="soft_social_media")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SoftSocialMediaRepository")
 */
class SoftSocialMedia
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
     * @ORM\Column(name="isTwitterMonitoring", type="boolean", nullable=true)
     */
    private $isTwitterMonitoring;

    /**
     * @var bool
     *
     * @ORM\Column(name="isTwitterAutoPublication", type="boolean", nullable=true)
     */
    private $isTwitterAutoPublication;

    /**
     * @var bool
     *
     * @ORM\Column(name="isFacebookMonitoring", type="boolean", nullable=true)
     */
    private $isFacebookMonitoring;

    /**
     * @var bool
     *
     * @ORM\Column(name="isFacebookAutoPublication", type="boolean", nullable=true)
     */
    private $isFacebookAutoPublication;

    /**
     * @var bool
     *
     * @ORM\Column(name="isLinkedinMonitoring", type="boolean", nullable=true)
     */
    private $isLinkedinMonitoring;

    /**
     * @var bool
     *
     * @ORM\Column(name="isLinkedinAutoPublication", type="boolean", nullable=true)
     */
    private $isLinkedinAutoPublication;

    /**
     * @var bool
     *
     * @ORM\Column(name="isInstagramMonitoring", type="boolean", nullable=true)
     */
    private $isInstagramMonitoring;

    /**
     * @var bool
     *
     * @ORM\Column(name="isInstagramAutoPublication", type="boolean", nullable=true)
     */
    private $isInstagramAutoPublication;

    /**
     * @ORM\OneToOne(targetEntity="SoftMain", mappedBy="softSocialMedia")
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
     * Set isTwitterMonitoring
     *
     * @param boolean $isTwitterMonitoring
     *
     * @return SoftSocialMedia
     */
    public function setIsTwitterMonitoring($isTwitterMonitoring)
    {
        $this->isTwitterMonitoring = $isTwitterMonitoring;

        return $this;
    }

    /**
     * Get isTwitterMonitoring
     *
     * @return boolean
     */
    public function getIsTwitterMonitoring()
    {
        return $this->isTwitterMonitoring;
    }

    /**
     * Set isTwitterAutoPublication
     *
     * @param boolean $isTwitterAutoPublication
     *
     * @return SoftSocialMedia
     */
    public function setIsTwitterAutoPublication($isTwitterAutoPublication)
    {
        $this->isTwitterAutoPublication = $isTwitterAutoPublication;

        return $this;
    }

    /**
     * Get isTwitterAutoPublication
     *
     * @return boolean
     */
    public function getIsTwitterAutoPublication()
    {
        return $this->isTwitterAutoPublication;
    }

    /**
     * Set isFacebookMonitoring
     *
     * @param boolean $isFacebookMonitoring
     *
     * @return SoftSocialMedia
     */
    public function setIsFacebookMonitoring($isFacebookMonitoring)
    {
        $this->isFacebookMonitoring = $isFacebookMonitoring;

        return $this;
    }

    /**
     * Get isFacebookMonitoring
     *
     * @return boolean
     */
    public function getIsFacebookMonitoring()
    {
        return $this->isFacebookMonitoring;
    }

    /**
     * Set isFacebookAutoPublication
     *
     * @param boolean $isFacebookAutoPublication
     *
     * @return SoftSocialMedia
     */
    public function setIsFacebookAutoPublication($isFacebookAutoPublication)
    {
        $this->isFacebookAutoPublication = $isFacebookAutoPublication;

        return $this;
    }

    /**
     * Get isFacebookAutoPublication
     *
     * @return boolean
     */
    public function getIsFacebookAutoPublication()
    {
        return $this->isFacebookAutoPublication;
    }

    /**
     * Set isLinkedinMonitoring
     *
     * @param boolean $isLinkedinMonitoring
     *
     * @return SoftSocialMedia
     */
    public function setIsLinkedinMonitoring($isLinkedinMonitoring)
    {
        $this->isLinkedinMonitoring = $isLinkedinMonitoring;

        return $this;
    }

    /**
     * Get isLinkedinMonitoring
     *
     * @return boolean
     */
    public function getIsLinkedinMonitoring()
    {
        return $this->isLinkedinMonitoring;
    }

    /**
     * Set isLinkedinAutoPublication
     *
     * @param boolean $isLinkedinAutoPublication
     *
     * @return SoftSocialMedia
     */
    public function setIsLinkedinAutoPublication($isLinkedinAutoPublication)
    {
        $this->isLinkedinAutoPublication = $isLinkedinAutoPublication;

        return $this;
    }

    /**
     * Get isLinkedinAutoPublication
     *
     * @return boolean
     */
    public function getIsLinkedinAutoPublication()
    {
        return $this->isLinkedinAutoPublication;
    }

    /**
     * Set isInstagramMonitoring
     *
     * @param boolean $isInstagramMonitoring
     *
     * @return SoftSocialMedia
     */
    public function setIsInstagramMonitoring($isInstagramMonitoring)
    {
        $this->isInstagramMonitoring = $isInstagramMonitoring;

        return $this;
    }

    /**
     * Get isInstagramMonitoring
     *
     * @return boolean
     */
    public function getIsInstagramMonitoring()
    {
        return $this->isInstagramMonitoring;
    }

    /**
     * Set isInstagramAutoPublication
     *
     * @param boolean $isInstagramAutoPublication
     *
     * @return SoftSocialMedia
     */
    public function setIsInstagramAutoPublication($isInstagramAutoPublication)
    {
        $this->isInstagramAutoPublication = $isInstagramAutoPublication;

        return $this;
    }

    /**
     * Get isInstagramAutoPublication
     *
     * @return boolean
     */
    public function getIsInstagramAutoPublication()
    {
        return $this->isInstagramAutoPublication;
    }

    /**
     * Set softMain
     *
     * @param \AppBundle\Entity\SoftMain $softMain
     *
     * @return SoftSocialMedia
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
