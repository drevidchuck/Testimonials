<?php
namespace V3N0m21\Testimonials\Api\Data;

interface TestimonialInterface
{
	const TESTIMONIAL_ID = 'testimonial_id';
    const USER_ID = 'user_id';
	const TITLE = 'title';
	const CONTENT = 'content';
	const CREATION_TIME = 'creation_time';
    const UPDATE_TIME   = 'update_time';
    const IS_ACTIVE     = 'is_active';

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get title
     *
     * @return string|null
     */
    public function getTitle();

    /**
     * Get content
     *
     * @return string|null
     */
    public function getContent();

    /**
     * Get creation time
     *
     * @return string|null
     */
    public function getCreationTime();

    /**
     * Get update time
     *
     * @return string|null
     */
    public function getUpdateTime();

    /**
     * Is active
     *
     * @return bool|null
     */
    public function isActive();

       /**
     * Set ID
     *
     * @param int $id
     * @return \V3N0m21\Testimonials\Api\Data\TestimonialInterface
     */
    public function setId($id);

    
    /**
     * Set title
     *
     * @param string $title
     * @return \V3N0m21\Testimonials\Api\Data\TestimonialInterface
     */
    public function setTitle($title);

    /**
     * Set content
     *
     * @param string $content
     * @return \V3N0m21\Testimonials\Api\Data\TestimonialInterface
     */
    public function setContent($content);

    /**
     * Set creation time
     *
     * @param string $creationTime
     * @return \V3N0m21\Testimonials\Api\Data\TestimonialInterface
     */
    public function setCreationTime($creationTime);

    /**
     * Set update time
     *
     * @param string $updateTime
     * @return \V3N0m21\Testimonials\Api\Data\TestimonialInterface
     */
    public function setUpdateTime($updateTime);

    /**
     * Set is active
     *
     * @param int|bool $isActive
     * @return \V3N0m21\Testimonials\Api\Data\TestimonialInterface
     */
    public function setIsActive($isActive); 

}