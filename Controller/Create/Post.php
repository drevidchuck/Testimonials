<?php
namespace V3N0m21\Testimonials\Controller\Create;

class Post extends \Magento\Framework\App\Action\Action
{
    protected $_objectManager;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Magento\Framework\ObjectManagerInterface $objectManager)
    {
        $this->_objectManager = $objectManager;
        parent::__construct($context);
    }

    public function execute()
    {
        $post = $this->getRequest()->getPostValue();
        $currenttime = date('Y-m-d H:i:s');
        $model = $this->_objectManager->create('V3N0m21\Testimonials\Model\Testimonial');
        $model->setData('user_id', $post['customer_id']);
        $model->setData('title', $post['testimonial_title']);
        $model->setData('content', $post['testimonial_content']);
        $model->setData('is_active', 1);
        $model->setData('creation_time', $currenttime);
        $model->setData('update_time', $currenttime);
        $model->save();
        $this->_redirect('*/');
        $this->messageManager->addSuccess(__('Your testimonial has been submitted successfully.'));
    }
}