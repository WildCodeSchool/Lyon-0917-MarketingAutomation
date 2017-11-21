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
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Versus", mappedBy="Software1")
     */
    private $versus1;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Versus", mappedBy="Software2")
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

}

