<?php
declare(strict_types=1);
namespace Epam\Customer\Plugin\Customer\Address;

use Magento\Customer\Block\Address\Edit;
use Magento\Framework\View\LayoutInterface;

class FieldPlugin
{
    /** @var LayoutInterface */
    private $layout;

    /**
     * @param LayoutInterface $layout
     */
    public function __construct(
        LayoutInterface $layout
    )
    {
        $this->layout = $layout;
    }
    /**
     * @param Edit $edit
     * @param string $result
     * @return string
     */
    public function afterGetNameBlockHtml(
        \Magento\Customer\Block\Address\Edit $edit,
        $result
    )
    {
        $block = $this->layout->createBlock(
            '\Epam\Customer\Block\Customer\Address\Form\Edit\Field',
            'address_custom_filed');
        return $result . $block->toHtml();
    }
}
