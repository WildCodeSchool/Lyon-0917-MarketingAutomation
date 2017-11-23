<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\Software;

/**
 * Tag
 *
 * @ORM\Table(name="tag")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TagRepository")
 */
class Tag
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
     * @ORM\Column(name="name", type="string", length=90, unique=true)
     */
    private $name;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="SoftMain", mappedBy="tags")
     *
     */
    private $softmain;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->softmain = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * @return Tag
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
     * Set description
     *
     * @param string $description
     *
     * @return Tag
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
     * Add softmain
     *
     * @param \AppBundle\Entity\SoftMain $softmain
     *
     * @return Tag
     */
    public function addSoftmain(\AppBundle\Entity\SoftMain $softmain)
    {
        $this->softmain[] = $softmain;

        return $this;
    }

    /**
     * Remove softmain
     *
     * @param \AppBundle\Entity\SoftMain $softmain
     */
    public function removeSoftmain(\AppBundle\Entity\SoftMain $softmain)
    {
        $this->softmain->removeElement($softmain);
    }

    /**
     * Get softmain
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSoftmain()
    {
        return $this->softmain;
    }
}
