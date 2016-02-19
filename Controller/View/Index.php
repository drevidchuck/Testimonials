<?php
namespace V3N0m21\Testimonials\Controller\View;

use \Magento\Framework\App\Action\Action;

class Index extends Action
{
    /** @var  \Magento\Framework\View\Result\Page */
    protected $resultPageFactory;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(\Magento\Framework\App\Action\Context $context,
                                \Magento\Framework\Controller\Result\ForwardFactory $resultForwardFactory
    )
    {
        $this->resultForwardFactory = $resultForwardFactory;
        parent::__construct($context);
    }

    /**
     * Testimonials Index, shows a list of recent testimonials.
     *
     * @return \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        $testimonial_id = $this->getRequest()->getParam('testimonial_id', $this->getRequest()->getParam('id', false));
        /** @var \V3N0m21\Testimonials\Helper\Testimonial $testimonial_helper */
        $testimonial_helper = $this->_objectManager->get('V3N0m21\Testimonials\Helper\Testimonial');
        $result_page = $testimonial_helper->prepareResultPost($this, $testimonial_id);
        if (!$result_page) {
            $resultForward = $this->resultForwardFactory->create();
            return $resultForward->forward('noroute');
        }
        return $result_page;
    }
}