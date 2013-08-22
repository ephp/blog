<?php

namespace Ephp\BlogBundle\Entity\Interfaces;

interface IPost {

    /**
     * Set title
     *
     * @param string $title
     * @return Post
     */
    public function setTitle($title);

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle();

    /**
     * Set media
     *
     * @param string $media
     * @return Post
     */
    public function setMedia($media);

    /**
     * Get media
     *
     * @return string 
     */
    public function getMedia();

    /**
     * Set body
     *
     * @param string $body
     * @return Post
     */
    public function setBody($body);

    /**
     * Get body
     *
     * @return string 
     */
    public function getBody();

    /**
     * Set url
     *
     * @param string $url
     * @return Post
     */
    public function setUrl($url);

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl();

    /**
     * Set slug
     *
     * @param string $slug
     * @return Post
     */
    public function setSlug($slug);

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug();

    /**
     * Sets createdAt.
     *
     * @param  DateTime $createdAt
     * @return $this
     */
    public function setCreatedAt(\DateTime $createdAt);

    /**
     * Returns createdAt.
     *
     * @return DateTime
     */
    public function getCreatedAt();

    /**
     * Sets updatedAt.
     *
     * @param  DateTime $updatedAt
     * @return $this
     */
    public function setUpdatedAt(\DateTime $updatedAt);

    /**
     * Returns updatedAt.
     *
     * @return DateTime
     */
    public function getUpdatedAt();

    /**
     * Sets user.
     *
     * @param  DateTime $updatedAt
     * @return $this
     */
    public function setUser($user);

    /**
     * Returns user.
     *
     * @return DateTime
     */
    public function getUser();
}
