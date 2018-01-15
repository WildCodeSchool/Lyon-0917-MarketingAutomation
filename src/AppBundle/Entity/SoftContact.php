<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SoftContact
 *
 * @ORM\Table(name="soft_contact")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SoftContactRepository")
 */
class SoftContact
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
     * @var string|null
     *
     * @ORM\Column(name="firstNaame", type="string", length=255, nullable=true)
     */
    private $firstNaame;

    /**
     * @var string|null
     *
     * @ORM\Column(name="lastName", type="string", length=255, nullable=true)
     */
    private $lastName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string|null
     *
     * @ORM\Column(name="phone", type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="language", type="string", length=255, nullable=true)
     */
    private $language;

    /**
     * @ORM\OneToOne(targetEntity="SoftMain", mappedBy="softContact")
     * @ORM\JoinColumn(name="softMainId", referencedColumnName="id",onDelete="CASCADE")
     */
    private $softMain;

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
     * Set firstNaame.
     *
     * @param string|null $firstNaame
     *
     * @return SoftContact
     */
    public function setFirstNaame($firstNaame = null)
    {
        $this->firstNaame = $firstNaame;

        return $this;
    }

    /**
     * Get firstNaame.
     *
     * @return string|null
     */
    public function getFirstNaame()
    {
        return $this->firstNaame;
    }

    /**
     * Set lastName.
     *
     * @param string|null $lastName
     *
     * @return SoftContact
     */
    public function setLastName($lastName = null)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName.
     *
     * @return string|null
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set email.
     *
     * @param string|null $email
     *
     * @return SoftContact
     */
    public function setEmail($email = null)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set phone.
     *
     * @param string|null $phone
     *
     * @return SoftContact
     */
    public function setPhone($phone = null)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone.
     *
     * @return string|null
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set language.
     *
     * @param string|null $language
     *
     * @return SoftContact
     */
    public function setLanguage($language = null)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language.
     *
     * @return string|null
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set softMain.
     *
     * @param \AppBundle\Entity\SoftMain|null $softMain
     *
     * @return SoftContact
     */
    public function setSoftMain(\AppBundle\Entity\SoftMain $softMain = null)
    {
        $this->softMain = $softMain;

        return $this;
    }

    /**
     * Get softMain.
     *
     * @return \AppBundle\Entity\SoftMain|null
     */
    public function getSoftMain()
    {
        return $this->softMain;
    }
}
