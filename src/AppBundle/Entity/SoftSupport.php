<?php

namespace AppBundle\Entity;

/**
 * SoftSupport
 */
class SoftSupport
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var bool
     */
    private $isEmailSupport;

    /**
     * @var bool
     */
    private $isPhoneSupport;

    /**
     * @var bool
     */
    private $isChatSupport;

    /**
     * @var bool
     */
    private $isKnowledgeBase;

    /**
     * @var string
     */
    private $knowledgeBaseLanguage;

    /**
     * @var bool
     */
    private $isTechnicalDocument;


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
     * Set isEmailSupport
     *
     * @param boolean $isEmailSupport
     *
     * @return SoftSupport
     */
    public function setIsEmailSupport($isEmailSupport)
    {
        $this->isEmailSupport = $isEmailSupport;

        return $this;
    }

    /**
     * Get isEmailSupport
     *
     * @return bool
     */
    public function getIsEmailSupport()
    {
        return $this->isEmailSupport;
    }

    /**
     * Set isPhoneSupport
     *
     * @param boolean $isPhoneSupport
     *
     * @return SoftSupport
     */
    public function setIsPhoneSupport($isPhoneSupport)
    {
        $this->isPhoneSupport = $isPhoneSupport;

        return $this;
    }

    /**
     * Get isPhoneSupport
     *
     * @return bool
     */
    public function getIsPhoneSupport()
    {
        return $this->isPhoneSupport;
    }

    /**
     * Set isChatSupport
     *
     * @param boolean $isChatSupport
     *
     * @return SoftSupport
     */
    public function setIsChatSupport($isChatSupport)
    {
        $this->isChatSupport = $isChatSupport;

        return $this;
    }

    /**
     * Get isChatSupport
     *
     * @return bool
     */
    public function getIsChatSupport()
    {
        return $this->isChatSupport;
    }

    /**
     * Set isKnowledgeBase
     *
     * @param boolean $isKnowledgeBase
     *
     * @return SoftSupport
     */
    public function setIsKnowledgeBase($isKnowledgeBase)
    {
        $this->isKnowledgeBase = $isKnowledgeBase;

        return $this;
    }

    /**
     * Get isKnowledgeBase
     *
     * @return bool
     */
    public function getIsKnowledgeBase()
    {
        return $this->isKnowledgeBase;
    }

    /**
     * Set knowledgeBaseLanguage
     *
     * @param string $knowledgeBaseLanguage
     *
     * @return SoftSupport
     */
    public function setKnowledgeBaseLanguage($knowledgeBaseLanguage)
    {
        $this->knowledgeBaseLanguage = $knowledgeBaseLanguage;

        return $this;
    }

    /**
     * Get knowledgeBaseLanguage
     *
     * @return string
     */
    public function getKnowledgeBaseLanguage()
    {
        return $this->knowledgeBaseLanguage;
    }

    /**
     * Set isTechnicalDocument
     *
     * @param boolean $isTechnicalDocument
     *
     * @return SoftSupport
     */
    public function setIsTechnicalDocument($isTechnicalDocument)
    {
        $this->isTechnicalDocument = $isTechnicalDocument;

        return $this;
    }

    /**
     * Get isTechnicalDocument
     *
     * @return bool
     */
    public function getIsTechnicalDocument()
    {
        return $this->isTechnicalDocument;
    }
}

