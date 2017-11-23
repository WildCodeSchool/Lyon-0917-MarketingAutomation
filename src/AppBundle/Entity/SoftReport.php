<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SoftReport
 *
 * @ORM\Table(name="soft_report")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SoftReportRepository")
 */
class SoftReport
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
     * @ORM\Column(name="isActivityReportCreation", type="boolean", nullable=true)
     */
    private $isActivityReportCreation;

    /**
     * @var bool
     *
     * @ORM\Column(name="isActivityReportPeriodicSend", type="boolean", nullable=true)
     */
    private $isActivityReportPeriodicSend;


    /**
     * @ORM\OneToOne(targetEntity="SoftMain", mappedBy="softReport")
     */
    private $softmain;


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
     * Set isActivityReportCreation
     *
     * @param boolean $isActivityReportCreation
     *
     * @return SoftReport
     */
    public function setIsActivityReportCreation($isActivityReportCreation)
    {
        $this->isActivityReportCreation = $isActivityReportCreation;

        return $this;
    }

    /**
     * Get isActivityReportCreation
     *
     * @return boolean
     */
    public function getIsActivityReportCreation()
    {
        return $this->isActivityReportCreation;
    }

    /**
     * Set isActivityReportPeriodicSend
     *
     * @param boolean $isActivityReportPeriodicSend
     *
     * @return SoftReport
     */
    public function setIsActivityReportPeriodicSend($isActivityReportPeriodicSend)
    {
        $this->isActivityReportPeriodicSend = $isActivityReportPeriodicSend;

        return $this;
    }

    /**
     * Get isActivityReportPeriodicSend
     *
     * @return boolean
     */
    public function getIsActivityReportPeriodicSend()
    {
        return $this->isActivityReportPeriodicSend;
    }

    /**
     * Set softmain
     *
     * @param \AppBundle\Entity\SoftMain $softmain
     *
     * @return SoftReport
     */
    public function setSoftmain(\AppBundle\Entity\SoftMain $softmain = null)
    {
        $this->softmain = $softmain;

        return $this;
    }

    /**
     * Get softmain
     *
     * @return \AppBundle\Entity\SoftMain
     */
    public function getSoftmain()
    {
        return $this->softmain;
    }
}
