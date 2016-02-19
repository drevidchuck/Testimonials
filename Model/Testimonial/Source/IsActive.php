<?php
namespace V3N0m21\Testimonials\Model\Testimonial\Source;

class IsActive implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * @var \V3N0m21\Testimonials\Model\Testimonial
     */
    protected $testimonial;

    /**
     * Constructor
     *
     * @param \V3N0m21\Testimonials\Model\testimonial $testimonial
     */
    public function __construct(\V3N0m21\Testimonials\Model\Testimonial $testimonial)
    {
        $this->testimonial = $testimonial;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options[] = ['label' => '', 'value' => ''];
        $availableOptions = $this->testimonial->getAvailableStatuses();
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }
}