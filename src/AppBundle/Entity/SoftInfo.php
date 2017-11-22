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
     * @var int
     *
     * @ORM\Column(name="creationDate", type="integer", nullable=true)
     */
    private $creationDate;

    /**
     * @var string
     *
     * @ORM\Column(name="annualTurnover", type="string", length=255, nullable=true)
     */
    private $annualTurnover;

    /**
     * @var string
     *
     * @ORM\Column(name="configCost", type="string", length=255, nullable=true)
     */
    private $configCost;

    /**
     * @var int
     *
     * @ORM\Column(name="subscriptionCost", type="integer", nullable=true)
     */
    private $subscriptionCost;

    /**
     * @var int
     *
     * @ORM\Column(name="trainingCost", type="integer", nullable=true)
     */
    private $trainingCost;

    /**
     * @var string
     *
     * @ORM\Column(name="webSite", type="string", length=255, nullable=true)
     */
    private $webSite;


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
     * Set rgpd
     *
     * @param boolean $rgpd
     *
     * @return SoftInfo
     */
    public function setRgpd($rgpd)
    {
        $this->rgpd = $rgpd;

        return $this;
    }

    /**
     * Get rgpd
     *
     * @return bool
     */
    public function getRgpd()
    {
        return $this->rgpd;
    }

    /**
     * Set customers
     *
     * @param string $customers
     *
     * @return SoftInfo
     */
    public function setCustomers($customers)
    {
        $this->customers = $customers;

        return $this;
    }

    /**
     * Get customers
     *
     * @return string
     */
    public function getCustomers()
    {
        return $this->customers;
    }

    /**
     * Set hostingCountry
     *
     * @param string $hostingCountry
     *
     * @return SoftInfo
     */
    public function setHostingCountry($hostingCountry)
    {
        $this->hostingCountry = $hostingCountry;

        return $this;
    }

    /**
     * Get hostingCountry
     *
     * @return string
     */
    public function getHostingCountry()
    {
        return $this->hostingCountry;
    }

    /**
     * Set creationDate
     *
     * @param integer $creationDate
     *
     * @return SoftInfo
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get creationDate
     *
     * @return int
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Set annualTurnover
     *
     * @param string $annualTurnover
     *
     * @return SoftInfo
     */
    public function setAnnualTurnover($annualTurnover)
    {
        $this->annualTurnover = $annualTurnover;

        return $this;
    }

    /**
     * Get annualTurnover
     *
     * @return string
     */
    public function getAnnualTurnover()
    {
        return $this->annualTurnover;
    }

    /**
     * Set configCost
     *
     * @param string $configCost
     *
     * @return SoftInfo
     */
    public function setConfigCost($configCost)
    {
        $this->configCost = $configCost;

        return $this;
    }

    /**
     * Get configCost
     *
     * @return string
     */
    public function getConfigCost()
    {
        return $this->configCost;
    }

    /**
     * Set subscriptionCost
     *
     * @param integer $subscriptionCost
     *
     * @return SoftInfo
     */
    public function setSubscriptionCost($subscriptionCost)
    {
        $this->subscriptionCost = $subscriptionCost;

        return $this;
    }

    /**
     * Get subscriptionCost
     *
     * @return int
     */
    public function getSubscriptionCost()
    {
        return $this->subscriptionCost;
    }

    /**
     * Set trainingCost
     *
     * @param integer $trainingCost
     *
     * @return SoftInfo
     */
    public function setTrainingCost($trainingCost)
    {
        $this->trainingCost = $trainingCost;

        return $this;
    }

    /**
     * Get trainingCost
     *
     * @return int
     */
    public function getTrainingCost()
    {
        return $this->trainingCost;
    }

    /**
     * Set webSite
     *
     * @param string $webSite
     *
     * @return SoftInfo
     */
    public function setWebSite($webSite)
    {
        $this->webSite = $webSite;

        return $this;
    }

    /**
     * Get webSite
     *
     * @return string
     */
    public function getWebSite()
    {
        return $this->webSite;
    }
}

