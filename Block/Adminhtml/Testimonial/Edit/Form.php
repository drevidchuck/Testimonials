<?php
namespace V3N0m21\Testimonials\Block\Adminhtml\Testimonial\Edit;

/**
 * Adminhtml testimonial edit form
 */
class Form extends \Magento\Backend\Block\Widget\Form\Generic
{

    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        array $data = []
    ) {
        $this->_systemStore = $systemStore;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Init form
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('testimonial_form');
        $this->setTitle(__('Testimonial Information'));
    }

    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        /** @var \V3N0m21\Testimonials\Model\Testimonial $model */
        $model = $this->_coreRegistry->registry('testimonials_testimonial');

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
            ['data' => ['id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post']]
        );

        $form->setHtmlIdPrefix('testimonial_');

        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('General Information'), 'class' => 'fieldset-wide']
        );

        if ($model->getTestimonialId()) {
            $fieldset->addField('testimonial_id', 'hidden', ['name' => 'testimonial_id']);
        }

        $fieldset->addField(
            'title',
            'text',
            ['name' => 'title', 'label' => __('Testimonial Title'), 'title' => __('Testimonial Title'), 'required' => true]
        );

        $fieldset->addField(
            'user_id',
            'text',
            [
                'name' => 'user_id',
                'label' => __('User Id'),
                'title' => __('User Id'),
                'required' => true,
                'class' => 'validate-digits'
            ]
        );

        $fieldset->addField(
            'is_active',
            'select',
            [
                'label' => __('Status'),
                'title' => __('Status'),
                'name' => 'is_active',
                'required' => true,
                'options' => ['1' => __('Enabled'), '0' => __('Disabled')]
            ]
        );
        if (!$model->getId()) {
            $model->setData('is_active', '1');
        }

        $fieldset->addField(
            'content',
            'editor',
            [
                'name' => 'content',
                'label' => __('Content'),
                'title' => __('Content'),
                'style' => 'height:36em',
                'required' => true
            ]
        );

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}