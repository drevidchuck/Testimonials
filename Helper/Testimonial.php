<?php namespace V3N0m21\Testimonials\Helper;

use Magento\Framework\App\Action\Action;

class Testimonial extends \Magento\Framework\App\Helper\AbstractHelper
{

    /**
     * @var \V3N0m21\Testimonials\Model\Testimonial
     */
    protected $_testimonial;

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * Constructor
     *
     * @param \Magento\Framework\App\Helper\Context $context
     * @param \V3N0m21\Testimonials\Model\Testimonial $testimonial
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \V3N0m21\Testimonials\Model\Testimonial $testimonial,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    )
    {
        $this->_testimonial = $testimonial;
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * @param Action $action
     * @param null $testimonialId
     * @return \Magento\Framework\View\Result\Page|bool
     */
    public function prepareResultPost(Action $action, $testimonialId = null)
    {
        if ($testimonialId !== null && $testimonialId !== $this->_testimonial->getId()) {
            $delimiterPosition = strrpos($testimonialId, '|');
            if ($delimiterPosition) {
                $testimonialId = substr($testimonialId, 0, $delimiterPosition);
            }

            if (!$this->_testimonial->load($testimonialId)) {
                return false;
            }
        }

        if (!$this->_testimonial->getId()) {
            return false;
        }

        /** @var \Magento\Framework\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->addHandle('blog_post_view');


        $resultPage->addPageLayoutHandles(['id' => $this->_testimonial->getId()]);


        $this->_eventManager->dispatch(
            'v3n0m21_testimonials_testimonial_render',
            ['testimonial' => $this->_testimonial, 'controller_action' => $action]
        );

        return $resultPage;
    }
}