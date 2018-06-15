<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * Many SoftMains have Many Tags.
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="softMains")
     * @ORM\JoinColumn(onDelete="CASCADE")
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
     * One SoftMain has Many Versus.
     * @ORM\OneToMany(targetEntity="Versus", mappedBy="software1")
     * @ORM\JoinColumn(name="versusId", referencedColumnName="id", onDelete="CASCADE")
     */
    private $versus1;

    /**
     * One SoftMain has Many Versus.
     * @ORM\OneToMany(targetEntity="Versus", mappedBy="software2")
     * @ORM\JoinColumn(name="versusId", referencedColumnName="id", onDelete="CASCADE")
     */
    private $versus2;

    /**
     * One SoftMain has One SoftInfo.
     * @ORM\OneToOne(targetEntity="SoftInfo", inversedBy="softMain", cascade={"persist"})
     * @ORM\JoinColumn(name="softInfoId", referencedColumnName="id", onDelete="CASCADE")
     */

    private $softInfo;

    /**
     * One SoftMain has One SoftOutbound.
     * @ORM\OneToOne(targetEntity="SoftOutbound", inversedBy="softMain", cascade={"persist"})
     * @ORM\JoinColumn(name="softOutBoundId", referencedColumnName="id",onDelete="CASCADE")
     */

    private $softOutbound;

    /**
     * One SoftMain has One SoftCommSupport.
     * @ORM\OneToOne(targetEntity="SoftCommSupport", inversedBy="softMain", cascade={"persist"})
     * @ORM\JoinColumn(name="softCommSupportId", referencedColumnName="id",onDelete="CASCADE")
     */
    private $softCommSupport;

    /**
     * One SoftMain has One SoftCommSupport.
     * @ORM\OneToOne(targetEntity="SoftLeadsOperation", inversedBy="softMain", cascade={"persist"})
     * @ORM\JoinColumn(name="softLeadsOperationId", referencedColumnName="id", onDelete="CASCADE")
     */
    private $softLeadsOperation;

    /**
     * One SoftMain has One SoftSegmentOperation.
     * @ORM\OneToOne(targetEntity="SoftSegmentOperation", inversedBy="softMain", cascade={"persist"})
     * @ORM\JoinColumn(name="softSegmentOperationId", referencedColumnName="id", onDelete="CASCADE")
     */
    private $softSegmentOperation;

    /**
     * One SoftMain has One SoftMarketingCampaign.
     * @ORM\OneToOne(targetEntity="SoftMarketingCampaign", inversedBy="softMain", cascade={"persist"})
     * @ORM\JoinColumn(name="softMarketingCampaignId", referencedColumnName="id", onDelete="CASCADE")
     */
    private $softMarketingCampaign;

    /**
     * One SoftMain has One SoftSocialMedia.
     * @ORM\OneToOne(targetEntity="SoftSocialMedia", inversedBy="softMain", cascade={"persist"})
     * @ORM\JoinColumn(name="softSocialMedia", referencedColumnName="id",onDelete="CASCADE")
     */
    private $softSocialMedia;

    /**
     * One SoftMain has One SoftReport.
     * @ORM\OneToOne(targetEntity="SoftReport", inversedBy="softMain", cascade={"persist"})
     * @ORM\JoinColumn(name="softReportId", referencedColumnName="id", onDelete="CASCADE")
     */
    private $softReport;

    /**
     * One SoftMain has One SeeAlso
     * @ORM\OneToOne(targetEntity="SoftSeeAlso", inversedBy="softMain", cascade={"persist"})
     * @ORM\JoinColumn(name="softSeeAlsoId", referencedColumnName="id", onDelete="CASCADE")

     */
    private $softSeeAlso;
    /**
     * One SoftMain has One SoftSupport.
     * @ORM\OneToOne(targetEntity="SoftSupport", inversedBy="softMain", cascade={"persist"})
     * @ORM\JoinColumn(name="softSupportId", referencedColumnName="id", onDelete="CASCADE")
     */
    private $softSupport;

    /**
     * One SoftMain has One SoftOtherFunctionnalities.
     * @ORM\OneToOne(targetEntity="SoftOtherFunctionnalities", inversedBy="softMain", cascade={"persist"})
     * @ORM\JoinColumn(name="softOtherFunctionnalitiesId", referencedColumnName="id", onDelete="CASCADE")
     */
    private $softOtherFunctionnalities;

    /**
     * One SoftMain has One SoftContact.
     * @ORM\OneToOne(targetEntity="SoftContact", inversedBy="softMain", cascade={"persist"})
     * @ORM\JoinColumn(name="softContactId", referencedColumnName="id", onDelete="CASCADE")
     */
    private $softContact;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\File(mimeTypes={ "image/png" })
     */
    private $logo;


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
     * @return mixed
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @param mixed $logo
     * @return SoftMain
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
        return $this;
    }


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name.
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
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set title.
     *
     * @param string|null $title
     *
     * @return SoftMain
     */
    public function setTitle($title = null)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title.
     *
     * @return string|null
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set logoUrl.
     *
     * @param string|null $logoUrl
     *
     * @return SoftMain
     */
    public function setLogoUrl($logoUrl = null)
    {
        $this->logoUrl = $logoUrl;

        return $this;
    }

    /**
     * Get logoUrl.
     *
     * @return string|null
     */
    public function getLogoUrl()
    {
        return $this->logoUrl;
    }

    /**
     * Set type.
     *
     * @param string|null $type
     *
     * @return SoftMain
     */
    public function setType($type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type.
     *
     * @return string|null
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set description.
     *
     * @param string|null $description
     *
     * @return SoftMain
     */
    public function setDescription($description = null)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string|null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set comments.
     *
     * @param string|null $comments
     *
     * @return SoftMain
     */
    public function setComments($comments = null)
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * Get comments.
     *
     * @return string|null
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set advantages.
     *
     * @param string|null $advantages
     *
     * @return SoftMain
     */
    public function setAdvantages($advantages = null)
    {
        $this->advantages = $advantages;

        return $this;
    }

    /**
     * Get advantages.
     *
     * @return string|null
     */
    public function getAdvantages()
    {
        return $this->advantages;
    }

    /**
     * Set drawbacks.
     *
     * @param string|null $drawbacks
     *
     * @return SoftMain
     */
    public function setDrawbacks($drawbacks = null)
    {
        $this->drawbacks = $drawbacks;

        return $this;
    }

    /**
     * Get drawbacks.
     *
     * @return string|null
     */
    public function getDrawbacks()
    {
        return $this->drawbacks;
    }

    /**
     * Set slug.
     *
     * @param string $slug
     *
     * @return SoftMain
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Add tag.
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
     * Remove tag.
     *
     * @param \AppBundle\Entity\Tag $tag
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeTag(\AppBundle\Entity\Tag $tag)
    {
        return $this->tags->removeElement($tag);
    }

    /**
     * Get tags.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Add versus1.
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
     * Remove versus1.
     *
     * @param \AppBundle\Entity\Versus $versus1
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeVersus1(\AppBundle\Entity\Versus $versus1)
    {
        return $this->versus1->removeElement($versus1);
    }

    /**
     * Get versus1.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVersus1()
    {
        return $this->versus1;
    }

    /**
     * Add versus2.
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
     * Remove versus2.
     *
     * @param \AppBundle\Entity\Versus $versus2
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeVersus2(\AppBundle\Entity\Versus $versus2)
    {
        return $this->versus2->removeElement($versus2);
    }

    /**
     * Get versus2.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVersus2()
    {
        return $this->versus2;
    }

    /**
     * Set softInfo.
     *
     * @param \AppBundle\Entity\SoftInfo|null $softInfo
     *
     * @return SoftMain
     */
    public function setSoftInfo(\AppBundle\Entity\SoftInfo $softInfo = null)
    {
        $this->softInfo = $softInfo;

        return $this;
    }

    /**
     * Get softInfo.
     *
     * @return \AppBundle\Entity\SoftInfo|null
     */
    public function getSoftInfo()
    {
        return $this->softInfo;
    }

    /**
     * Set softOutbound.
     *
     * @param \AppBundle\Entity\SoftOutbound|null $softOutbound
     *
     * @return SoftMain
     */
    public function setSoftOutbound(\AppBundle\Entity\SoftOutbound $softOutbound = null)
    {
        $this->softOutbound = $softOutbound;

        return $this;
    }

    /**
     * Get softOutbound.
     *
     * @return \AppBundle\Entity\SoftOutbound|null
     */
    public function getSoftOutbound()
    {
        return $this->softOutbound;
    }

    /**
     * Set softCommSupport.
     *
     * @param \AppBundle\Entity\SoftCommSupport|null $softCommSupport
     *
     * @return SoftMain
     */
    public function setSoftCommSupport(\AppBundle\Entity\SoftCommSupport $softCommSupport = null)
    {
        $this->softCommSupport = $softCommSupport;

        return $this;
    }

    /**
     * Get softCommSupport.
     *
     * @return \AppBundle\Entity\SoftCommSupport|null
     */
    public function getSoftCommSupport()
    {
        return $this->softCommSupport;
    }

    /**
     * Set softLeadsOperation.
     *
     * @param \AppBundle\Entity\SoftLeadsOperation|null $softLeadsOperation
     *
     * @return SoftMain
     */
    public function setSoftLeadsOperation(\AppBundle\Entity\SoftLeadsOperation $softLeadsOperation = null)
    {
        $this->softLeadsOperation = $softLeadsOperation;

        return $this;
    }

    /**
     * Get softLeadsOperation.
     *
     * @return \AppBundle\Entity\SoftLeadsOperation|null
     */
    public function getSoftLeadsOperation()
    {
        return $this->softLeadsOperation;
    }

    /**
     * Set softSegmentOperation.
     *
     * @param \AppBundle\Entity\SoftSegmentOperation|null $softSegmentOperation
     *
     * @return SoftMain
     */
    public function setSoftSegmentOperation(\AppBundle\Entity\SoftSegmentOperation $softSegmentOperation = null)
    {
        $this->softSegmentOperation = $softSegmentOperation;

        return $this;
    }

    /**
     * Get softSegmentOperation.
     *
     * @return \AppBundle\Entity\SoftSegmentOperation|null
     */
    public function getSoftSegmentOperation()
    {
        return $this->softSegmentOperation;
    }

    /**
     * Set softMarketingCampaign.
     *
     * @param \AppBundle\Entity\SoftMarketingCampaign|null $softMarketingCampaign
     *
     * @return SoftMain
     */
    public function setSoftMarketingCampaign(\AppBundle\Entity\SoftMarketingCampaign $softMarketingCampaign = null)
    {
        $this->softMarketingCampaign = $softMarketingCampaign;

        return $this;
    }

    /**
     * Get softMarketingCampaign.
     *
     * @return \AppBundle\Entity\SoftMarketingCampaign|null
     */
    public function getSoftMarketingCampaign()
    {
        return $this->softMarketingCampaign;
    }

    /**
     * Set softSocialMedia.
     *
     * @param \AppBundle\Entity\SoftSocialMedia|null $softSocialMedia
     *
     * @return SoftMain
     */
    public function setSoftSocialMedia(\AppBundle\Entity\SoftSocialMedia $softSocialMedia = null)
    {
        $this->softSocialMedia = $softSocialMedia;

        return $this;
    }

    /**
     * Get softSocialMedia.
     *
     * @return \AppBundle\Entity\SoftSocialMedia|null
     */
    public function getSoftSocialMedia()
    {
        return $this->softSocialMedia;
    }

    /**
     * Set softReport.
     *
     * @param \AppBundle\Entity\SoftReport|null $softReport
     *
     * @return SoftMain
     */
    public function setSoftReport(\AppBundle\Entity\SoftReport $softReport = null)
    {
        $this->softReport = $softReport;

        return $this;
    }

    /**
     * Get softReport.
     *
     * @return \AppBundle\Entity\SoftReport|null
     */
    public function getSoftReport()
    {
        return $this->softReport;
    }

    /**
     * Set softSupport.
     *
     * @param \AppBundle\Entity\SoftSupport|null $softSupport
     *
     * @return SoftMain
     */
    public function setSoftSupport(\AppBundle\Entity\SoftSupport $softSupport = null)
    {
        $this->softSupport = $softSupport;

        return $this;
    }

    /**
     * Get softSupport.
     *
     * @return \AppBundle\Entity\SoftSupport|null
     */
    public function getSoftSupport()
    {
        return $this->softSupport;
    }

    /**
     * Set softOtherFunctionnalities.
     *
     * @param \AppBundle\Entity\SoftOtherFunctionnalities|null $softOtherFunctionnalities
     *
     * @return SoftMain
     */
    public function setSoftOtherFunctionnalities(\AppBundle\Entity\SoftOtherFunctionnalities $softOtherFunctionnalities = null)
    {
        $this->softOtherFunctionnalities = $softOtherFunctionnalities;

        return $this;
    }

    /**
     * Get softOtherFunctionnalities.
     *
     * @return \AppBundle\Entity\SoftOtherFunctionnalities|null
     */
    public function getSoftOtherFunctionnalities()
    {
        return $this->softOtherFunctionnalities;
    }

    /**
     * Set softContact.
     *
     * @param \AppBundle\Entity\SoftContact|null $softContact
     *
     * @return SoftMain
     */
    public function setSoftContact(\AppBundle\Entity\SoftContact $softContact = null)
    {
        $this->softContact = $softContact;

        return $this;
    }

    /**
     * Get softContact.
     *
     * @return \AppBundle\Entity\SoftContact|null
     */
    public function getSoftContact()
    {
        return $this->softContact;
    }

    /**
     * @return \AppBundle\Entity\SoftSeeAlso|null
     */
    public function getSoftSeeAlso()
    {
        return $this->softSeeAlso;
    }

    /**
     * @param mixed $softSeeAlso
     * @return SoftMain
     */
    public function setSoftSeeAlso($softSeeAlso)
    {
        $this->softSeeAlso = $softSeeAlso;
        return $this;
    }

    public function __toString()
    {
        return $this->getName();
    }

}
