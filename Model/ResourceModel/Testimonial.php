<?php
namespace V3N0m21\Testimonials\Model\ResourceModel;

/**
 * Testimonials testimonial mysql resource
 */
class Testimonial extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
	/**
     * @var \Magento\Framework\Stdlib\DateTime\DateTime
     */
    protected $_date;

    /**
     * Construct
     *
     * @param \Magento\Framework\Model\ResourceModel\Db\Context $context
     * @param \Magento\Framework\Stdlib\DateTime\DateTime $date
     * @param string|null $resourcePrefix
     */
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context,
        \Magento\Framework\Stdlib\DateTime\DateTime $date,
        $resourcePrefix = null
    ) {
        parent::__construct($context, $resourcePrefix);
        $this->_date = $date;
    }

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('v3n0m21_testimonials_testimonial', 'testimonial_id');
    }

    /**
     * Process testimonial data before saving
     *
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return $this
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _beforeSave(\Magento\Framework\Model\AbstractModel $object)
    {

        if ($object->isObjectNew() && !$object->hasCreationTime()) {
            $object->setCreationTime($this->_date->gmtDate());
        }

        $object->setUpdateTime($this->_date->gmtDate());

        return parent::_beforeSave($object);
    }

    /**
     * @param \Magento\Framework\Model\AbstractModel $object
     * @param mixed $value
     * @param string $field
     * @return $this
     */
    public function load(\Magento\Framework\Model\AbstractModel $object, $value, $field = null)
    {
        if (!is_numeric($value) && is_null($field)) {
            $field = 'testimonial_id';
        }

        return parent::load($object, $value, $field);
    }

    /**
     * Retrieve select object for load object data
     *
     * @param string $field
     * @param mixed $value
     * @param \V3N0m21\Testimonials\Model\Testimonial $object
     * @return \Zend_Db_Select
     */
    protected function _getLoadSelect($field, $value, $object)
    {
        $select = parent::_getLoadSelect($field, $value, $object);

        if ($object->getStoreId()) {

            $select->where(
                'is_active = ?',
                1
            )->limit(
                1
            );
        }

        return $select;
    }

    /**
     * @param string $id
     * @param int $isActive
     * @return \Magento\Framework\DB\Select
     */
    public function _getById($id, $isActive = 1)
    {
        $select = $this->getConnection()->select()->from(
            ['bp' => $this->getMainTable()]
        )->where(
            'bp.testimonial_id = ?',
            $id
        );

        if (!is_null($isActive)) {
            $select->where('bp.is_active = ?', $isActive);
        }
        $select->reset(\Zend_Db_Select::COLUMNS)->columns('bp.testimonial_id')->limit(1);
        return $this->getConnection()->fetchOne($select);
    }




}