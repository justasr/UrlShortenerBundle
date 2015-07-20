<?php

namespace UrlShortenerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ShortLink
 *
 * @ORM\Table()
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="UrlShortenerBundle\Entity\ShortLinkRepository")
 */
class ShortLink
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * 
     * @ORM\Column(name="type", length=32,  type="string", nullable=true)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="short_url", length=255, type="string", nullable=true)
     */
    private $shortUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="long_url", length=255, type="string", nullable=true)
     */
    private $longUrl;
    /**
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\PreUpdate
     * @ORM\PrePersist
     */
    public function doOnPrePersist()
    {
        $this->createdAt= new \DateTime();
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
     * Set type
     *
     * @param string $type
     * @return ShortLink
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
     * Set shortUrl
     *
     * @param string $shortUrl
     * @return ShortLink
     */
    public function setShortUrl($shortUrl)
    {
        $this->shortUrl = $shortUrl;

        return $this;
    }

    /**
     * Get shortUrl
     *
     * @return string 
     */
    public function getShortUrl()
    {
        return $this->shortUrl;
    }

    /**
     * Set longUrl
     *
     * @param string $longUrl
     * @return ShortLink
     */
    public function setLongUrl($longUrl)
    {
        $this->longUrl = $longUrl;

        return $this;
    }

    /**
     * Get longUrl
     *
     * @return string 
     */
    public function getLongUrl()
    {
        return $this->longUrl;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return ShortLink
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
