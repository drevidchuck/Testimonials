<?php
namespace V3N0m21\Testimonials\Block;

class TestimonialView extends \Magento\Framework\View\Element\Template implements
    \Magento\Framework\DataObject\IdentityInterface
{

    /**
     * Construct
     *
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \V3N0m21\Testimonials\Model\Testimonial $testimonial
     * @param \V3N0m21\Testimonials\Model\TestimonialFactory $testimonialFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \V3N0m21\Testimonials\Model\Testimonial $testimonial,
        \V3N0m21\Testimonials\Model\TestimonialFactory $testimonialFactory,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->_testimonial = $testimonial;
        $this->_testimonialFactory = $testimonialFactory;
    }

    /**
     * @return \V3N0m21\Testimonials\Model\Testimonial
     */
    public function getTestimonial()
    {
        if (!$this->hasData('testimonial')) {
            if ($this->getTestimonialId()) {
                /** @var \V3N0m21\Testimonials\Model\Testimonial $page */
                $testimonial = $this->_testimonialFactory->create();
            } else {
                $testimonial = $this->_testimonial;
            }
            $this->setData('testimonial', $testimonial);
        }
        return $this->getData('testimonial');
    }

    /**
     *
     * @return array
     */
    public function getIdentities()
    {
        return [\V3N0m21\Testimonials\Model\testimonial::CACHE_TAG . '_' . $this->getTestimonial()->getId()];
    }

}