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
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\SoftMain", inversedBy="versus1")
     */
    private $software1;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\SoftMain", inversedBy="versus2")
     */
    private $software2;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;


}

