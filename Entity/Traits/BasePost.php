<?php

namespace Ephp\BlogBundle\Entity\Traits;

trait BasePost {

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=128)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="media", type="string", length=255, nullable=true)
     */
    private $media;

    /**
     * @var \Ephp\ACLBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Ephp\DragDropBundle\Entity\File")
     * @ORM\JoinColumn(name="file_id", referencedColumnName="id", nullable=true)
     */
    private $picture;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text")
     */
    private $body;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="month", type="integer")
     */
    private $month;

    /**
     * @var integer
     *
     * @ORM\Column(name="year", type="integer")
     */
    private $year;

    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(name="slug", type="string", length=128, unique=true)
     */
    private $slug;

    /**
     * Set title
     *
     * @param string $title
     * @return Post
     */
    public function setTitle($title) {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Set media
     *
     * @param string $media
     * @return Post
     */
    public function setMedia($media) {
        $this->media = $media;

        return $this;
    }

    /**
     * Get media
     *
     * @return string 
     */
    public function getMedia() {
        return $this->media;
    }

    /**
     * Set body
     *
     * @param string $body
     * @return Post
     */
    public function setBody($body) {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string 
     */
    public function getBody() {
        return $this->body;
    }

    /**
     * Set picture
     *
     * @param string $picture
     * @return Post
     */
    public function setPicture($picture) {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return string 
     */
    public function getPicture() {
        return $this->picture;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Post
     */
    public function setUrl($url) {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl() {
        return $this->url;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Post
     */
    public function setSlug($slug) {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug() {
        return $this->slug;
    }
    
    /**
     * Set year
     *
     * @param integer $year
     * @return Post
     */
    public function setYear($year) {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return integer 
     */
    public function getYear() {
        return $this->year;
    }
    
    /**
     * Set month
     *
     * @param integer $month
     * @return Post
     */
    public function setMonth($month) {
        $this->month = $month;

        return $this;
    }

    /**
     * Get month
     *
     * @return integer 
     */
    public function getMonth() {
        return $this->month;
    }

    
    public function isImg() {
        return $this->media && $this->picture;
    }
    
    public function isVideo() {
        return $this->media && !$this->picture;
    }
    
    /**
     * @ORM\PrePersist 
     */
    public function prePersist() {
        $now = new \DateTime('now');
        $this->year = $now->format('Y');
        $this->month = $now->format('m');
    }
}
