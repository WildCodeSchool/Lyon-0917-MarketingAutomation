<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SoftCommSupport
 *
 * @ORM\Table(name="soft_comm_support")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SoftCommSupportRepository")
 */
class SoftCommSupport
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
     * @ORM\Column(name="isLandingPage", type="boolean", nullable=true)
     */
    private $isLandingPage;

    /**
     * @var bool
     *
     * @ORM\Column(name="isForm", type="boolean", nullable=true)
     */
    private $isForm;

    /**
     * @var bool
     *
     * @ORM\Column(name="isTracking", type="boolean", nullable=true)
     */
    private $isTracking;

    /**
     * @var bool
     *
     * @ORM\Column(name="isLiveChat", type="boolean", nullable=true)
     */
    private $isLiveChat;


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
     * Set isLandingPage
     *
     * @param boolean $isLandingPage
     *
     * @return SoftCommSupport
     */
    public function setIsLandingPage($isLandingPage)
    {
        $this->isLandingPage = $isLandingPage;

        return $this;
    }

    /**
     * Get isLandingPage
     *
     * @return bool
     */
    public function getIsLandingPage()
    {
        return $this->isLandingPage;
    }

    /**
     * Set isForm
     *
     * @param boolean $isForm
     *
     * @return SoftCommSupport
     */
    public function setIsForm($isForm)
    {
        $this->isForm = $isForm;

        return $this;
    }

    /**
     * Get isForm
     *
     * @return bool
     */
    public function getIsForm()
    {
        return $this->isForm;
    }

    /**
     * Set isTracking
     *
     * @param boolean $isTracking
     *
     * @return SoftCommSupport
     */
    public function setIsTracking($isTracking)
    {
        $this->isTracking = $isTracking;

        return $this;
    }

    /**
     * Get isTracking
     *
     * @return bool
     */
    public function getIsTracking()
    {
        return $this->isTracking;
    }

    /**
     * Set isLiveChat
     *
     * @param boolean $isLiveChat
     *
     * @return SoftCommSupport
     */
    public function setIsLiveChat($isLiveChat)
    {
        $this->isLiveChat = $isLiveChat;

        return $this;
    }

    /**
     * Get isLiveChat
     *
     * @return bool
     */
    public function getIsLiveChat()
    {
        return $this->isLiveChat;
    }
}

