<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SoftInfo
 *
 * @ORM\Table(name="soft_info")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SoftInfoRepository")
 */
class SoftInfo
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
     * @ORM\Column(name="rgpd", type="boolean", nullable=true)
     */
    private $rgpd;

    /**
     * @var string
     *
     * @ORM\Column(name="customers", type="string", length=255, nullable=true)
     */
    private $customers;

    /**
     * @var string
     *
     * @ORM\Column(name="hostingCountry", type="string", length=255, nullable=true)
     */
    private $hostingCountry;

    /**
     * @var string
     *
     * @ORM\Column(name="creationDate", type="string", length=255, nullable=true)
     */
    private $creationDate;


    /**
     * @var string
     *
     * @ORM\Column(name="subscriptionCost", type="string", length=255, nullable=true)
     */
    private $subscriptionCost;

    /**
     * @var string
     *
     * @ORM\Column(name="trainingCost", type="text", nullable=true)
     */
    private $trainingCost;

    /**
     * @var string
     *
     * @ORM\Column(name="webSite", type="string", length=255, nullable=true)
     */
    private $webSite;


    /**
     * @ORM\OneToOne(targetEntity="SoftMain", mappedBy="softInfo")
     * @ORM\JoinColumn(name="softMainId", referencedColumnName="id",onDelete="CASCADE")
     */
    private $softMain;



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
     * Set rgpd.
     *
     * @param bool|null $rgpd
     *
     * @return SoftInfo
     */
    public function setRgpd($rgpd = null)
    {
        $this->rgpd = $rgpd;

        return $this;
    }

    /**
     * Get rgpd.
     *
     * @return bool|null
     */
    public function getRgpd()
    {
        return $this->rgpd;
    }

    /**
     * Set customers.
     *
     * @param string|null $customers
     *
     * @return SoftInfo
     */
    public function setCustomers($customers = null)
    {
        $this->customers = $customers;

        return $this;
    }

    /**
     * Get customers.
     *
     * @return string|null
     */
    public function getCustomers()
    {
        return $this->customers;
    }

    /**
     * Set hostingCountry.
     *
     * @param string|null $hostingCountry
     *
     * @return SoftInfo
     */
    public function setHostingCountry($hostingCountry = null)
    {
        $this->hostingCountry = $hostingCountry;

        return $this;
    }

    /**
     * Get hostingCountry.
     *
     * @return string|null
     */
    public function getHostingCountry()
    {
        return $this->hostingCountry;
    }

    /**
     * Set creationDate.
     *
     * @param string|null $creationDate
     *
     * @return SoftInfo
     */
    public function setCreationDate($creationDate = null)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get creationDate.
     *
     * @return string|null
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Set subscriptionCost.
     *
     * @param string|null $subscriptionCost
     *
     * @return SoftInfo
     */
    public function setSubscriptionCost($subscriptionCost = null)
    {
        $this->subscriptionCost = $subscriptionCost;

        return $this;
    }

    /**
     * Get subscriptionCost.
     *
     * @return string|null
     */
    public function getSubscriptionCost()
    {
        return $this->subscriptionCost;
    }

    /**
     * Set trainingCost.
     *
     * @param string|null $trainingCost
     *
     * @return SoftInfo
     */
    public function setTrainingCost($trainingCost = null)
    {
        $this->trainingCost = $trainingCost;

        return $this;
    }

    /**
     * Get trainingCost.
     *
     * @return string|null
     */
    public function getTrainingCost()
    {
        return $this->trainingCost;
    }

    /**
     * Set webSite.
     *
     * @param string|null $webSite
     *
     * @return SoftInfo
     */
    public function setWebSite($webSite = null)
    {
        $this->webSite = $webSite;

        return $this;
    }

    /**
     * Get webSite.
     *
     * @return string|null
     */
    public function getWebSite()
    {
        return $this->webSite;
    }

    /**
     * Set softMain.
     *
     * @param \AppBundle\Entity\SoftMain|null $softMain
     *
     * @return SoftInfo
     */
    public function setSoftMain(\AppBundle\Entity\SoftMain $softMain = null)
    {
        $this->softMain = $softMain;

        return $this;
    }

    /**
     * Get softMain.
     *
     * @return \AppBundle\Entity\SoftMain|null
     */
    public function getSoftMain()
    {
        return $this->softMain;
    }

}
