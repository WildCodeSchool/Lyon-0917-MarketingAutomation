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
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * Many Versus have One Software.
     * @ORM\ManyToOne(targetEntity="SoftMain", inversedBy="versus1")
     * @ORM\JoinColumn(name="softMain1", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     */

    private $software1;

    /**
     * Many Versus have One Software.
     * @ORM\ManyToOne(targetEntity="SoftMain", inversedBy="versus2")
     * @ORM\JoinColumn(name="softMain2", referencedColumnName="id",onDelete="CASCADE", nullable=false)
     */
    private $software2;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

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
     * Set title.
     *
     * @param string|null $title
     *
     * @return Versus
     */
    public function setTitle($title = null)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title.
     *
     * @return string|null
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description.
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
     * Get description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set software1.
     *
     * @param \AppBundle\Entity\SoftMain|null $software1
     *
     * @return Versus
     */
    public function setSoftware1(\AppBundle\Entity\SoftMain $software1 = null)
    {
        $this->software1 = $software1;

        return $this;
    }

    /**
     * Get software1.
     *
     * @return \AppBundle\Entity\SoftMain|null
     */
    public function getSoftware1()
    {
        return $this->software1;
    }

    /**
     * Set software2.
     *
     * @param \AppBundle\Entity\SoftMain|null $software2
     *
     * @return Versus
     */
    public function setSoftware2(\AppBundle\Entity\SoftMain $software2 = null)
    {
        $this->software2 = $software2;

        return $this;
    }

    /**
     * Get software2.
     *
     * @return \AppBundle\Entity\SoftMain|null
     */
    public function getSoftware2()
    {
        return $this->software2;
    }

    public function __toString()
    {
        return $this->getSoftware1() . ' - ' . $this->getSoftware2();
        // TODO: Implement __toString() method.
    }
}
