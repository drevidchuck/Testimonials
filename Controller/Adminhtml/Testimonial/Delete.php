<?php
namespace V3N0m21\Testimonials\Controller\Adminhtml\Testimonial;

use Magento\Backend\App\Action;
use Magento\TestFramework\ErrorLog\Logger;

class Delete extends \Magento\Backend\App\Action
{

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('V3N0m21_Testimonials::delete');
    }

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('testimonial_id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $model = $this->_objectManager->create('V3N0m21\Testimonials\Model\Testimonial');
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccess(__('The testimonial has been deleted.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['testimonial_id' => $id]);
            }
        }
        $this->messageManager->addError(__('We can\'t find a testimonial to delete.'));
        return $resultRedirect->setPath('*/*/');
    }
}
