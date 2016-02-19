<?php
namespace V3N0m21\Testimonials\Model;

use V3N0m21\Testimonials\Api\Data\TestimonialInterface;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\App\ObjectManager;



class Testimonial extends \Magento\Framework\Model\AbstractModel implements TestimonialInterface, IdentityInterface
{
	/**#@+
     * Testimonial's Statuses
     */
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;
    /**#@-*/

    /**
     * CMS page cache tag
     */
    const CACHE_TAG = 'testimonials_testimonial';

    /**
     * @var string
     */
    protected $_cacheTag = 'testimonials_testimonial';

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'testimonials_testimonial';

    // /**
    //  * @param \Magento\Framework\Model\Context $context
    //  * @param \Magento\Framework\Registry $registry
    //  * @param \Magento\Framework\Model\ResourceModel\AbstractResource|null $resource
    //  * @param \Magento\Framework\Data\Collection\AbstractDb|null $resourceCollection
    //  * @param array $data
    //  */
    // function __construct(
    //     \Magento\Framework\Model\Context $context,
    //     \Magento\Framework\Registry $registry,
    //     \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
    //     \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
    //     array $data = [])
    // {
    //     parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    // }

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('V3N0m21\Testimonials\Model\ResourceModel\Testimonial');
    }

    /**
     * Prepare testimonial's statuses.
     *
     * @return array
     */
    public function getAvailableStatuses()
    {
        return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
    }

    /**
     * Return unique ID(s) for each object in system
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->getData(self::TESTIMONIAL_ID);
    }

    public function getById($id)
    {
        return $this->_getResource()->_getById($id);
    }

    /**
     * Get title
     *
     * @return string|null
     */
    public function getTitle()
    {
        return $this->getData(self::TITLE);
    }

    /**
     * Get content
     *
     * @return string|null
     */
    public function getContent()
    {
        return $this->getData(self::CONTENT);
    }

    /**
     * Get creation time
     *
     * @return string|null
     */
    public function getCreationTime()
    {
        return $this->getData(self::CREATION_TIME);
    }

    /**
     * Get update time
     *
     * @return string|null
     */
    public function getUpdateTime()
    {
        return $this->getData(self::UPDATE_TIME);
    }

    /**
     * Get created By
     *
     * @return string|null
     */
    public function getCreatedBy()
    {
        $user = $this->getData(self::USER_ID);
        $objectManager = ObjectManager::getInstance();
        $customerRepository =  $objectManager->get('Magento\Customer\Api\CustomerRepositoryInterface');
        $customer = $customerRepository->getById($user);
        $customerFullName = $customer->getFirstname() . " " . $customer->getLastname();



        return $customerFullName;
    }


    /**
     * Is active
     *
     * @return bool|null
     */
    public function isActive()
    {
        return (bool) $this->getData(self::IS_ACTIVE);
    }

    /**
     * Set ID
     *
     * @param int $id
     * @return \V3N0m21\Testimonials\Api\Data\TestimonialInterface
     */
    public function setId($id)
    {
        return $this->setData(self::TESTIMONIAL_ID, $id);
    }

    /**
     * Set title
     *
     * @param string $title
     * @return \V3N0m21\Testimonials\Api\Data\TestimonialInterface
     */
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * Set content
     *
     * @param string $content
     * @return \V3N0m21\Testimonials\Api\Data\TestimonialInterface
     */
    public function setContent($content)
    {
        return $this->setData(self::CONTENT, $content);
    }

    /**
     * Set creation time
     *
     * @param string $creation_time
     * @return \V3N0m21\Testimonials\Api\Data\TestimonialInterface
     */
    public function setCreationTime($creation_time)
    {
        return $this->setData(self::CREATION_TIME, $creation_time);
    }

    /**
     * Set update time
     *
     * @param string $update_time
     * @return \V3N0m21\Testimonials\Api\Data\TestimonialInterface
     */
    public function setUpdateTime($update_time)
    {
        return $this->setData(self::UPDATE_TIME, $update_time);
    }

    /**
     * Set is active
     *
     * @param int|bool $is_active
     * @return \V3N0m21\Testimonials\Api\Data\TestimonialInterface
     */
    public function setIsActive($is_active)
    {
        return $this->setData(self::IS_ACTIVE, $is_active);
    }




}