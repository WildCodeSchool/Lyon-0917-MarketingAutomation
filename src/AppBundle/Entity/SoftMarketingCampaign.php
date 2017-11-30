<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SoftMarketingCampaign
 *
 * @ORM\Table(name="soft_marketing_campaign")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SoftMarketingCampaignRepository")
 */
class SoftMarketingCampaign
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
     * @ORM\Column(name="isLeadScoring", type="boolean", nullable=true)
     */
    private $isLeadScoring;

    /**
     * @var bool
     *
     * @ORM\Column(name="isCreationCampaign", type="boolean", nullable=true)
     */
    private $isCreationCampaign;

    /**
     * @var bool
     *
     * @ORM\Column(name="isDripMarketingCampaign", type="boolean", nullable=true)
     */
    private $isDripMarketingCampaign;

    /**
     * @var bool
     *
     * @ORM\Column(name="isDragAndDrop", type="boolean", nullable=true)
     */
    private $isDragAndDrop;


    /**
     * @ORM\OneToOne(targetEntity="SoftMain", mappedBy="softMarketingCampaign")
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
     * Set isLeadScoring
     *
     * @param boolean $isLeadScoring
     *
     * @return SoftMarketingCampaign
     */
    public function setIsLeadScoring($isLeadScoring)
    {
        $this->isLeadScoring = $isLeadScoring;

        return $this;
    }

    /**
     * Get isLeadScoring
     *
     * @return boolean
     */
    public function getIsLeadScoring()
    {
        return $this->isLeadScoring;
    }

    /**
     * Set isCreationCampaign
     *
     * @param boolean $isCreationCampaign
     *
     * @return SoftMarketingCampaign
     */
    public function setIsCreationCampaign($isCreationCampaign)
    {
        $this->isCreationCampaign = $isCreationCampaign;

        return $this;
    }

    /**
     * Get isCreationCampaign
     *
     * @return boolean
     */
    public function getIsCreationCampaign()
    {
        return $this->isCreationCampaign;
    }

    /**
     * Set isDripMarketingCampaign
     *
     * @param boolean $isDripMarketingCampaign
     *
     * @return SoftMarketingCampaign
     */
    public function setIsDripMarketingCampaign($isDripMarketingCampaign)
    {
        $this->isDripMarketingCampaign = $isDripMarketingCampaign;

        return $this;
    }

    /**
     * Get isDripMarketingCampaign
     *
     * @return boolean
     */
    public function getIsDripMarketingCampaign()
    {
        return $this->isDripMarketingCampaign;
    }

    /**
     * Set isDragAndDrop
     *
     * @param boolean $isDragAndDrop
     *
     * @return SoftMarketingCampaign
     */
    public function setIsDragAndDrop($isDragAndDrop)
    {
        $this->isDragAndDrop = $isDragAndDrop;

        return $this;
    }

    /**
     * Get isDragAndDrop
     *
     * @return boolean
     */
    public function getIsDragAndDrop()
    {
        return $this->isDragAndDrop;
    }

    /**
     * Set softMain
     *
     * @param \AppBundle\Entity\SoftMain $softMain
     *
     * @return SoftMarketingCampaign
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
