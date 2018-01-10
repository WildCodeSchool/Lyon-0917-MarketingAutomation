<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SoftSegmentOperation
 *
 * @ORM\Table(name="soft_segment_operation")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SoftSegmentOperationRepository")
 */
class SoftSegmentOperation
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
     * @ORM\Column(name="isSegmentCreation", type="boolean", nullable=true)
     */
    private $isSegmentCreation;

    /**
     * @var bool
     *
     * @ORM\Column(name="isIntelligentSegment", type="boolean", nullable=true)
     */
    private $isIntelligentSegment;

    /**
     * @ORM\OneToOne(targetEntity="SoftMain", mappedBy="softSegmentOperation")
     * @ORM\JoinColumn(name="softMainId", referencedColumnName="id", onDelete="CASCADE")
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
     * Set isSegmentCreation
     *
     * @param boolean $isSegmentCreation
     *
     * @return SoftSegmentOperation
     */
    public function setIsSegmentCreation($isSegmentCreation)
    {
        $this->isSegmentCreation = $isSegmentCreation;

        return $this;
    }

    /**
     * Get isSegmentCreation
     *
     * @return boolean
     */
    public function getIsSegmentCreation()
    {
        return $this->isSegmentCreation;
    }

    /**
     * Set isIntelligentSegment
     *
     * @param boolean $isIntelligentSegment
     *
     * @return SoftSegmentOperation
     */
    public function setIsIntelligentSegment($isIntelligentSegment)
    {
        $this->isIntelligentSegment = $isIntelligentSegment;

        return $this;
    }

    /**
     * Get isIntelligentSegment
     *
     * @return boolean
     */
    public function getIsIntelligentSegment()
    {
        return $this->isIntelligentSegment;
    }

    /**
     * Set softMain
     *
     * @param \AppBundle\Entity\SoftMain $softMain
     *
     * @return SoftSegmentOperation
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
