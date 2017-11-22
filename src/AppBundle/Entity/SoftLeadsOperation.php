<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SoftLeadsOperation
 *
 * @ORM\Table(name="soft_leads_operation")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SoftLeadsOperationRepository")
 */
class SoftLeadsOperation
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
     * @ORM\Column(name="isContactObject", type="boolean", nullable=true)
     */
    private $isContactObject;

    /**
     * @var bool
     *
     * @ORM\Column(name="isCompanyObject", type="boolean", nullable=true)
     */
    private $isCompanyObject;

    /**
     * @var bool
     *
     * @ORM\Column(name="isDefinedFields", type="boolean", nullable=true)
     */
    private $isDefinedFields;

    /**
     * @var bool
     *
     * @ORM\Column(name="isIllimitedFields", type="boolean", nullable=true)
     */
    private $isIllimitedFields;

    /**
     * @var bool
     *
     * @ORM\Column(name="isImportCsv", type="boolean", nullable=true)
     */
    private $isImportCsv;

    /**
     * @var bool
     *
     * @ORM\Column(name="isAutoDuplicate", type="boolean", nullable=true)
     */
    private $isAutoDuplicate;

    /**
     * @var bool
     *
     * @ORM\Column(name="isLeadStages", type="boolean", nullable=true)
     */
    private $isLeadStages;


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
     * Set isContactObject
     *
     * @param boolean $isContactObject
     *
     * @return SoftLeadsOperation
     */
    public function setIsContactObject($isContactObject)
    {
        $this->isContactObject = $isContactObject;

        return $this;
    }

    /**
     * Get isContactObject
     *
     * @return bool
     */
    public function getIsContactObject()
    {
        return $this->isContactObject;
    }

    /**
     * Set isCompanyObject
     *
     * @param boolean $isCompanyObject
     *
     * @return SoftLeadsOperation
     */
    public function setIsCompanyObject($isCompanyObject)
    {
        $this->isCompanyObject = $isCompanyObject;

        return $this;
    }

    /**
     * Get isCompanyObject
     *
     * @return bool
     */
    public function getIsCompanyObject()
    {
        return $this->isCompanyObject;
    }

    /**
     * Set isDefinedFields
     *
     * @param boolean $isDefinedFields
     *
     * @return SoftLeadsOperation
     */
    public function setIsDefinedFields($isDefinedFields)
    {
        $this->isDefinedFields = $isDefinedFields;

        return $this;
    }

    /**
     * Get isDefinedFields
     *
     * @return bool
     */
    public function getIsDefinedFields()
    {
        return $this->isDefinedFields;
    }

    /**
     * Set isIllimitedFields
     *
     * @param boolean $isIllimitedFields
     *
     * @return SoftLeadsOperation
     */
    public function setIsIllimitedFields($isIllimitedFields)
    {
        $this->isIllimitedFields = $isIllimitedFields;

        return $this;
    }

    /**
     * Get isIllimitedFields
     *
     * @return bool
     */
    public function getIsIllimitedFields()
    {
        return $this->isIllimitedFields;
    }

    /**
     * Set isImportCsv
     *
     * @param boolean $isImportCsv
     *
     * @return SoftLeadsOperation
     */
    public function setIsImportCsv($isImportCsv)
    {
        $this->isImportCsv = $isImportCsv;

        return $this;
    }

    /**
     * Get isImportCsv
     *
     * @return bool
     */
    public function getIsImportCsv()
    {
        return $this->isImportCsv;
    }

    /**
     * Set isAutoDuplicate
     *
     * @param boolean $isAutoDuplicate
     *
     * @return SoftLeadsOperation
     */
    public function setIsAutoDuplicate($isAutoDuplicate)
    {
        $this->isAutoDuplicate = $isAutoDuplicate;

        return $this;
    }

    /**
     * Get isAutoDuplicate
     *
     * @return bool
     */
    public function getIsAutoDuplicate()
    {
        return $this->isAutoDuplicate;
    }

    /**
     * Set isLeadStages
     *
     * @param boolean $isLeadStages
     *
     * @return SoftLeadsOperation
     */
    public function setIsLeadStages($isLeadStages)
    {
        $this->isLeadStages = $isLeadStages;

        return $this;
    }

    /**
     * Get isLeadStages
     *
     * @return bool
     */
    public function getIsLeadStages()
    {
        return $this->isLeadStages;
    }
}

