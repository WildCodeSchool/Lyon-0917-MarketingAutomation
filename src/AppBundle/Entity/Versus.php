<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(name="software1", type="string", length=255)
     */
    private $software1;

    /**
     * @var string
     *
     * @ORM\Column(name="software2", type="string", length=255)
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
     * Set software1
     *
     * @param string $software1
     *
     * @return Versus
     */
    public function setSoftware1($software1)
    {
        $this->software1 = $software1;

        return $this;
    }

    /**
     * Get software1
     *
     * @return string
     */
    public function getSoftware1()
    {
        return $this->software1;
    }

    /**
     * Set software2
     *
     * @param string $software2
     *
     * @return Versus
     */
    public function setSoftware2($software2)
    {
        $this->software2 = $software2;

        return $this;
    }

    /**
     * Get software2
     *
     * @return string
     */
    public function getSoftware2()
    {
        return $this->software2;
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
}

