<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

/**
 * Versus
 *
 * @ORM\Table(name="versus")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VersusRepository")
 */
class Versus
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
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * Many Versus have One Software.
     * @ORM\ManyToOne(targetEntity="SoftMain", inversedBy="versus1")
     */

    private $software1;

    /**
     * Many Versus have One Software.
     * @ORM\ManyToOne(targetEntity="SoftMain", inversedBy="versus2")
     */
    private $software2;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

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
     * Set name
     *
     * @param string $name
     *
     * @return Versus
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
     * Set title
     *
     * @param string $title
     *
     * @return Versus
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Versus
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
     * Set software1
     *
     * @param \AppBundle\Entity\SoftMain $software1
     *
     * @return Versus
     */
    public function setSoftware1(\AppBundle\Entity\SoftMain $software1 = null)
    {
        $this->software1 = $software1;

        return $this;
    }

    /**
     * Get software1
     *
     * @return \AppBundle\Entity\SoftMain
     */
    public function getSoftware1()
    {
        return $this->software1;
    }

    /**
     * Set software2
     *
     * @param \AppBundle\Entity\SoftMain $software2
     *
     * @return Versus
     */
    public function setSoftware2(\AppBundle\Entity\SoftMain $software2 = null)
    {
        $this->software2 = $software2;

        return $this;
    }

    /**
     * Get software2
     *
     * @return \AppBundle\Entity\SoftMain
     */
    public function getSoftware2()
    {
        return $this->software2;
    }
}
