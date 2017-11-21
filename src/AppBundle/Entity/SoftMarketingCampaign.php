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
     * Get id
     *
     * @return int
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
     * @return bool
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
     * @return bool
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
     * @return bool
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
     * @return bool
     */
    public function getIsDragAndDrop()
    {
        return $this->isDragAndDrop;
    }
}

