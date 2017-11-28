<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SoftOutbound
 *
 * @ORM\Table(name="soft_outbound")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SoftOutboundRepository")
 */
class SoftOutbound
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
     * @ORM\Column(name="isEmail", type="boolean", nullable=true)
     */
    private $isEmail;

    /**
     * @var bool
     *
     * @ORM\Column(name="isSms", type="boolean", nullable=true)
     */
    private $isSms;

    /**
     * @var bool
     *
     * @ORM\Column(name="isPopin", type="boolean", nullable=true)
     */
    private $isPopin;

    /**
     * @var bool
     *
     * @ORM\Column(name="isMailPostal", type="boolean", nullable=true)
     */
    private $isMailPostal;

    /**
     * @var bool
     *
     * @ORM\Column(name="isCallCenter", type="boolean", nullable=true)
     */
    private $isCallCenter;

    /**
     * @var bool
     *
     * @ORM\Column(name="isPushMobile", type="boolean", nullable=true)
     */
    private $isPushMobile;

    /**
     * @var bool
     *
     * @ORM\Column(name="isApi", type="boolean", nullable=true)
     */
    private $isApi;

    /**
     * @ORM\OneToOne(targetEntity="SoftMain", mappedBy="softOutbound")
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
     * Set isEmail
     *
     * @param boolean $isEmail
     *
     * @return SoftOutbound
     */
    public function setIsEmail($isEmail)
    {
        $this->isEmail = $isEmail;

        return $this;
    }

    /**
     * Get isEmail
     *
     * @return boolean
     */
    public function getIsEmail()
    {
        return $this->isEmail;
    }

    /**
     * Set isSms
     *
     * @param boolean $isSms
     *
     * @return SoftOutbound
     */
    public function setIsSms($isSms)
    {
        $this->isSms = $isSms;

        return $this;
    }

    /**
     * Get isSms
     *
     * @return boolean
     */
    public function getIsSms()
    {
        return $this->isSms;
    }

    /**
     * Set isPopin
     *
     * @param boolean $isPopin
     *
     * @return SoftOutbound
     */
    public function setIsPopin($isPopin)
    {
        $this->isPopin = $isPopin;

        return $this;
    }

    /**
     * Get isPopin
     *
     * @return boolean
     */
    public function getIsPopin()
    {
        return $this->isPopin;
    }

    /**
     * Set isMailPostal
     *
     * @param boolean $isMailPostal
     *
     * @return SoftOutbound
     */
    public function setIsMailPostal($isMailPostal)
    {
        $this->isMailPostal = $isMailPostal;

        return $this;
    }

    /**
     * Get isMailPostal
     *
     * @return boolean
     */
    public function getIsMailPostal()
    {
        return $this->isMailPostal;
    }

    /**
     * Set isCallCenter
     *
     * @param boolean $isCallCenter
     *
     * @return SoftOutbound
     */
    public function setIsCallCenter($isCallCenter)
    {
        $this->isCallCenter = $isCallCenter;

        return $this;
    }

    /**
     * Get isCallCenter
     *
     * @return boolean
     */
    public function getIsCallCenter()
    {
        return $this->isCallCenter;
    }

    /**
     * Set isPushMobile
     *
     * @param boolean $isPushMobile
     *
     * @return SoftOutbound
     */
    public function setIsPushMobile($isPushMobile)
    {
        $this->isPushMobile = $isPushMobile;

        return $this;
    }

    /**
     * Get isPushMobile
     *
     * @return boolean
     */
    public function getIsPushMobile()
    {
        return $this->isPushMobile;
    }

    /**
     * Set isApi
     *
     * @param boolean $isApi
     *
     * @return SoftOutbound
     */
    public function setIsApi($isApi)
    {
        $this->isApi = $isApi;

        return $this;
    }

    /**
     * Get isApi
     *
     * @return boolean
     */
    public function getIsApi()
    {
        return $this->isApi;
    }

    /**
     * Set softMain
     *
     * @param \AppBundle\Entity\SoftMain $softMain
     *
     * @return SoftOutbound
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
