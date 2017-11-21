<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @var array
     *
     * @ORM\Column(name="versus1", type="array", nullable=true)
     */
    private $versus1;

    /**
     * @var array
     *
     * @ORM\Column(name="versus2", type="array", nullable=true)
     */
    private $versus2;


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
     * Set versus1
     *
     * @param array $versus1
     *
     * @return SoftMain
     */
    public function setVersus1($versus1)
    {
        $this->versus1 = $versus1;

        return $this;
    }

    /**
     * Get versus1
     *
     * @return array
     */
    public function getVersus1()
    {
        return $this->versus1;
    }

    /**
     * Set versus2
     *
     * @param array $versus2
     *
     * @return SoftMain
     */
    public function setVersus2($versus2)
    {
        $this->versus2 = $versus2;

        return $this;
    }

    /**
     * Get versus2
     *
     * @return array
     */
    public function getVersus2()
    {
        return $this->versus2;
    }
}

