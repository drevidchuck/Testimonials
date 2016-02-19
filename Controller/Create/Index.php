<?php
namespace V3N0m21\Testimonials\Controller\Create;
use \Magento\Framework\App\Action\Action;
use \Magento\Customer\Model\Session;

class Index extends Action
{
    /** @var  \Magento\Framework\View\Result\Page */
    protected $resultPageFactory;
    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(\Magento\Framework\App\Action\Context $context,
                                \Magento\Framework\View\Result\PageFactory $resultPageFactory)
    {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }


    /**
     * Testimonials Index, shows a list of recent testimonials.
     *
     * @return \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('Create testimonial'));
        return $resultPage;
    }

    public function createTestimonialAction()
    {
        $data = $this->getRequest()->getPost();
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $testimonial = $objectManager->get('V3N0m21\Testimonials\Model\Testimonial');
        $testimonial->setId();
    }

}