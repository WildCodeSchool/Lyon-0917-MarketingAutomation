<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SoftSeeAlso
 *
 * @ORM\Table(name="soft_see_also")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SoftSeeAlsoRepository")
 */
class SoftSeeAlso
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
     * @var array
     *
     * @ORM\Column(name="softSeeAlsoArray", type="array", nullable=true)
     */
    private $softSeeAlsoArray;

    /**
     *
     * @ORM\OneToOne(targetEntity="SoftMain", mappedBy="softSeeAlso")
     * @ORM\JoinColumn(name="softMainId", referencedColumnName="id", onDelete="CASCADE")
     */
    private $softMain;
    /**
     * @var array
     * @ORM\Column(name="booleans", type="array", nullable=true)
     */
    private $booleans;


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
     * Set softSeeAlsoArray
     *
     * @param array $softSeeAlsoArray
     *
     * @return SoftSeeAlso
     */
    public function setSoftSeeAlsoArray($softSeeAlsoArray)
    {
        $this->softSeeAlsoArray = $softSeeAlsoArray;

        return $this;
    }

    /**
     * Get softSeeAlsoArray
     *
     * @return array
     */
    public function getSoftSeeAlsoArray()
    {
        return $this->softSeeAlsoArray;
    }

    /**
     * Set softMain
     *
     * @param integer $softMain
     *
     * @return SoftSeeAlso
     */
    public function setSoftMain($softMain)
    {
        $this->softMain = $softMain;

        return $this;
    }

    /**
     * Get softMain
     *
     * @return int
     */
    public function getSoftMain()
    {
        return $this->softMain;
    }

    /**
     * @return array
     */
    public function getBooleans(): array
    {
        return $this->booleans;
    }

    /**
     * @param array $booleans
     * @return SoftSeeAlso
     */
    public function setBooleans(array $booleans): SoftSeeAlso
    {
        $this->booleans = $booleans;
        return $this;
    }

}

