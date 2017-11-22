<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * SoftMain
 *
 * @ORM\Table(name="soft_main")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SoftMainRepository")
 */
class SoftMain
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * Many Users have Many Groups.
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="softwares")
     */
    private $tags;

    /**
     * @var string
     *
     * @ORM\Column(name="logoUrl", type="string", length=255, nullable=true)
     */
    private $logoUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="comments", type="text", nullable=true)
     */
    private $comments;

    /**
     * @var string
     *
     * @ORM\Column(name="advantages", type="text", nullable=true)
     */
    private $advantages;

    /**
     * @var string
     *
     * @ORM\Column(name="drawbacks", type="text", nullable=true)
     */
    private $drawbacks;

    /**
     * One Software has Many Versus.
     * @ORM\OneToMany(targetEntity="Versus", mappedBy="software1")
     */
    private $versus1;

    /**
     * One Software has Many Versus.
     * @ORM\OneToMany(targetEntity="Versus", mappedBy="software2")
     */
    private $versus2;

    /**
     * One MainSoftware has One SoftInfo.
     * @ORM\OneToOne(targetEntity="SoftInfo")
     * @ORM\JoinColumn(name="SoftInfo_id", referencedColumnName="id")
     */

    private $SoftInfo;

    /**
     * One MainSoftware has One SoftOutbound.
     * @ORM\OneToOne(targetEntity="SoftOutbound")
     * @ORM\JoinColumn(name="SoftOutbound_id", referencedColumnName="id")
     */

    private $SoftOutbound;

    /**
     * One MainSoftware has One SoftCommSupport.
     * @ORM\OneToOne(targetEntity="SoftCommSupport")
     * @ORM\JoinColumn(name="SoftCommSupport_id", referencedColumnName="id")
     */
    private $SoftCommSupport;

    /**
     * One MainSoftware has One SoftCommSupport.
     * @ORM\OneToOne(targetEntity="SoftLeadsOperation")
     * @ORM\JoinColumn(name="SoftLeadsOperation_id", referencedColumnName="id")
     */
    private $SoftLeadsOperation;

    /**
     * One MainSoftware has One SoftSegmentOperation.
     * @ORM\OneToOne(targetEntity="SoftSegmentOperation")
     * @ORM\JoinColumn(name="SoftSegmentOperation_id", referencedColumnName="id")
     */
    private $SoftSegmentOperation;

    /**
     * One MainSoftware has One SoftMarketingCampaign.
     * @ORM\OneToOne(targetEntity="SoftMarketingCampaign")
     * @ORM\JoinColumn(name="SoftMarketingCampaign_id", referencedColumnName="id")
     */
    private $SoftMarketingCampaign;

    /**
     * One MainSoftware has One SoftSocialMedia.
     * @ORM\OneToOne(targetEntity="SoftSocialMedia")
     * @ORM\JoinColumn(name="SoftSocialMedia_id", referencedColumnName="id")
     */
    private $SoftSocialMedia;

    /**
     * One MainSoftware has One SoftReport.
     * @ORM\OneToOne(targetEntity="SoftReport")
     * @ORM\JoinColumn(name="SoftReport_id", referencedColumnName="id")
     */
    private $SoftReport;

    /**
     * One MainSoftware has One SoftSupport.
     * @ORM\OneToOne(targetEntity="SoftSupport")
     * @ORM\JoinColumn(name="SoftSupport_id", referencedColumnName="id")
     */
    private $SoftSupport;

    /**
     * One MainSoftware has One SoftOtherFunctionnalities.
     * @ORM\OneToOne(targetEntity="SoftOtherFunctionnalities")
     * @ORM\JoinColumn(name="SoftOtherFunctionnalities_id", referencedColumnName="id")
     */
    private $SoftOtherFunctionnalities;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
        $this->versus1 = new \Doctrine\Common\Collections\ArrayCollection();
        $this->versus2 = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set name
     *
     * @param string $name
     *
     * @return SoftMain
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set logoUrl
     *
     * @param string $logoUrl
     *
     * @return SoftMain
     */
    public function setLogoUrl($logoUrl)
    {
        $this->logoUrl = $logoUrl;

        return $this;
    }

    /**
     * Get logoUrl
     *
     * @return string
     */
    public function getLogoUrl()
    {
        return $this->logoUrl;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return SoftMain
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return SoftMain
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set comments
     *
     * @param string $comments
     *
     * @return SoftMain
     */
    public function setComments($comments)
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * Get comments
     *
     * @return string
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set advantages
     *
     * @param string $advantages
     *
     * @return SoftMain
     */
    public function setAdvantages($advantages)
    {
        $this->advantages = $advantages;

        return $this;
    }

    /**
     * Get advantages
     *
     * @return string
     */
    public function getAdvantages()
    {
        return $this->advantages;
    }

    /**
     * Set drawbacks
     *
     * @param string $drawbacks
     *
     * @return SoftMain
     */
    public function setDrawbacks($drawbacks)
    {
        $this->drawbacks = $drawbacks;

        return $this;
    }

    /**
     * Get drawbacks
     *
     * @return string
     */
    public function getDrawbacks()
    {
        return $this->drawbacks;
    }

    /**
     * Add tag
     *
     * @param \AppBundle\Entity\Tag $tag
     *
     * @return SoftMain
     */
    public function addTag(\AppBundle\Entity\Tag $tag)
    {
        $this->tags[] = $tag;

        return $this;
    }

    /**
     * Remove tag
     *
     * @param \AppBundle\Entity\Tag $tag
     */
    public function removeTag(\AppBundle\Entity\Tag $tag)
    {
        $this->tags->removeElement($tag);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Add versus1
     *
     * @param \AppBundle\Entity\Versus $versus1
     *
     * @return SoftMain
     */
    public function addVersus1(\AppBundle\Entity\Versus $versus1)
    {
        $this->versus1[] = $versus1;

        return $this;
    }

    /**
     * Remove versus1
     *
     * @param \AppBundle\Entity\Versus $versus1
     */
    public function removeVersus1(\AppBundle\Entity\Versus $versus1)
    {
        $this->versus1->removeElement($versus1);
    }

    /**
     * Get versus1
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVersus1()
    {
        return $this->versus1;
    }

    /**
     * Add versus2
     *
     * @param \AppBundle\Entity\Versus $versus2
     *
     * @return SoftMain
     */
    public function addVersus2(\AppBundle\Entity\Versus $versus2)
    {
        $this->versus2[] = $versus2;

        return $this;
    }

    /**
     * Remove versus2
     *
     * @param \AppBundle\Entity\Versus $versus2
     */
    public function removeVersus2(\AppBundle\Entity\Versus $versus2)
    {
        $this->versus2->removeElement($versus2);
    }

    /**
     * Get versus2
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVersus2()
    {
        return $this->versus2;
    }

    /**
     * Set softInfo
     *
     * @param \AppBundle\Entity\SoftInfo $softInfo
     *
     * @return SoftMain
     */
    public function setSoftInfo(\AppBundle\Entity\SoftInfo $softInfo = null)
    {
        $this->SoftInfo = $softInfo;

        return $this;
    }

    /**
     * Get softInfo
     *
     * @return \AppBundle\Entity\SoftInfo
     */
    public function getSoftInfo()
    {
        return $this->SoftInfo;
    }

    /**
     * Set softOutbound
     *
     * @param \AppBundle\Entity\SoftOutbound $softOutbound
     *
     * @return SoftMain
     */
    public function setSoftOutbound(\AppBundle\Entity\SoftOutbound $softOutbound = null)
    {
        $this->SoftOutbound = $softOutbound;

        return $this;
    }

    /**
     * Get softOutbound
     *
     * @return \AppBundle\Entity\SoftOutbound
     */
    public function getSoftOutbound()
    {
        return $this->SoftOutbound;
    }

    /**
     * Set softCommSupport
     *
     * @param \AppBundle\Entity\SoftCommSupport $softCommSupport
     *
     * @return SoftMain
     */
    public function setSoftCommSupport(\AppBundle\Entity\SoftCommSupport $softCommSupport = null)
    {
        $this->SoftCommSupport = $softCommSupport;

        return $this;
    }

    /**
     * Get softCommSupport
     *
     * @return \AppBundle\Entity\SoftCommSupport
     */
    public function getSoftCommSupport()
    {
        return $this->SoftCommSupport;
    }

    /**
     * Set softLeadsOperation
     *
     * @param \AppBundle\Entity\SoftLeadsOperation $softLeadsOperation
     *
     * @return SoftMain
     */
    public function setSoftLeadsOperation(\AppBundle\Entity\SoftLeadsOperation $softLeadsOperation = null)
    {
        $this->SoftLeadsOperation = $softLeadsOperation;

        return $this;
    }

    /**
     * Get softLeadsOperation
     *
     * @return \AppBundle\Entity\SoftLeadsOperation
     */
    public function getSoftLeadsOperation()
    {
        return $this->SoftLeadsOperation;
    }

    /**
     * Set softSegmentOperation
     *
     * @param \AppBundle\Entity\SoftSegmentOperation $softSegmentOperation
     *
     * @return SoftMain
     */
    public function setSoftSegmentOperation(\AppBundle\Entity\SoftSegmentOperation $softSegmentOperation = null)
    {
        $this->SoftSegmentOperation = $softSegmentOperation;

        return $this;
    }

    /**
     * Get softSegmentOperation
     *
     * @return \AppBundle\Entity\SoftSegmentOperation
     */
    public function getSoftSegmentOperation()
    {
        return $this->SoftSegmentOperation;
    }

    /**
     * Set softMarketingCampaign
     *
     * @param \AppBundle\Entity\SoftMarketingCampaign $softMarketingCampaign
     *
     * @return SoftMain
     */
    public function setSoftMarketingCampaign(\AppBundle\Entity\SoftMarketingCampaign $softMarketingCampaign = null)
    {
        $this->SoftMarketingCampaign = $softMarketingCampaign;

        return $this;
    }

    /**
     * Get softMarketingCampaign
     *
     * @return \AppBundle\Entity\SoftMarketingCampaign
     */
    public function getSoftMarketingCampaign()
    {
        return $this->SoftMarketingCampaign;
    }

    /**
     * Set softSocialMedia
     *
     * @param \AppBundle\Entity\SoftSocialMedia $softSocialMedia
     *
     * @return SoftMain
     */
    public function setSoftSocialMedia(\AppBundle\Entity\SoftSocialMedia $softSocialMedia = null)
    {
        $this->SoftSocialMedia = $softSocialMedia;

        return $this;
    }

    /**
     * Get softSocialMedia
     *
     * @return \AppBundle\Entity\SoftSocialMedia
     */
    public function getSoftSocialMedia()
    {
        return $this->SoftSocialMedia;
    }

    /**
     * Set softReport
     *
     * @param \AppBundle\Entity\SoftReport $softReport
     *
     * @return SoftMain
     */
    public function setSoftReport(\AppBundle\Entity\SoftReport $softReport = null)
    {
        $this->SoftReport = $softReport;

        return $this;
    }

    /**
     * Get softReport
     *
     * @return \AppBundle\Entity\SoftReport
     */
    public function getSoftReport()
    {
        return $this->SoftReport;
    }

    /**
     * Set softSupport
     *
     * @param \AppBundle\Entity\SoftSupport $softSupport
     *
     * @return SoftMain
     */
    public function setSoftSupport(\AppBundle\Entity\SoftSupport $softSupport = null)
    {
        $this->SoftSupport = $softSupport;

        return $this;
    }

    /**
     * Get softSupport
     *
     * @return \AppBundle\Entity\SoftSupport
     */
    public function getSoftSupport()
    {
        return $this->SoftSupport;
    }

    /**
     * Set softOtherFunctionnalities
     *
     * @param \AppBundle\Entity\SoftOtherFunctionnalities $softOtherFunctionnalities
     *
     * @return SoftMain
     */
    public function setSoftOtherFunctionnalities(\AppBundle\Entity\SoftOtherFunctionnalities $softOtherFunctionnalities = null)
    {
        $this->SoftOtherFunctionnalities = $softOtherFunctionnalities;

        return $this;
    }

    /**
     * Get softOtherFunctionnalities
     *
     * @return \AppBundle\Entity\SoftOtherFunctionnalities
     */
    public function getSoftOtherFunctionnalities()
    {
        return $this->SoftOtherFunctionnalities;
    }
}
