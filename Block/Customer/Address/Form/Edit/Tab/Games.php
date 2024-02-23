<?php
declare(strict_types=1);

namespace Epam\Customer\Block\Customer\Address\Form\Edit\Tab;

use Magento\Backend\Block\Template;
use Magento\Backend\Block\Template\Context;
use Magento\Directory\Helper\Data as DirectoryHelper;
use Magento\Framework\Json\Helper\Data as JsonHelper;
use Magento\Ui\Component\Layout\Tabs\TabInterface;
use Magento\Framework\App\RequestInterface;

class Games extends Template implements TabInterface
{
    /**
     * @param Context $context
     * @param array $data
     * @param JsonHelper|null $jsonHelper
     * @param DirectoryHelper|null $directoryHelper
     * @param RequestInterface $request
     */
    public function __construct(
        private readonly RequestInterface $request,
        Template\Context                  $context,
        array                             $data = [],
        ?JsonHelper                       $jsonHelper = null,
        ?DirectoryHelper                  $directoryHelper = null,
    )
    {
        parent::__construct($context, $data, $jsonHelper, $directoryHelper);
    }

    public function getTabLabel()
    {
        return __('Computer Games');
    }

    public function getTabTitle()
    {
        return __('PC Games');
    }

    public function getTabClass()
    {
        return '';
    }

    public function getTabUrl()
    {
        return $this->getUrl('customer/*/games', ['_current' => true]);
    }

    /**
     * @return true
     */
    public function isAjaxLoaded()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function canShowTab()
    {
        return (bool)$this->getCustomerId();
    }

    /**
     * @return bool
     */
    public function isHidden()
    {
        return !$this->getCustomerId();
    }

    /**
     * @return int
     */
    private function getCustomerId(): int
    {
        return (int)$this->request->getParam('id');
    }
}
