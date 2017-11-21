<?php

namespace AppBundle\Entity;

/**
 * SoftLeadsOperation
 */
class SoftLeadsOperation
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var bool
     */
    private $isContactObject;

    /**
     * @var bool
     */
    private $isCompanyObject;

    /**
     * @var bool
     */
    private $isDefinedFields;

    /**
     * @var bool
     */
    private $isIllimitedFields;

    /**
     * @var bool
     */
    private $isImportCsv;

    /**
     * @var bool
     */
    private $isAutoDuplicate;

    /**
     * @var bool
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

