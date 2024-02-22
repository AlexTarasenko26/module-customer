<?php
declare(strict_types=1);

namespace Epam\Customer\Block\Customer\Address\Form\Edit;

use Magento\Customer\Api\AddressRepositoryInterface;
use Magento\Customer\Api\Data\AddressInterface;
use Magento\Customer\Api\Data\AddressInterfaceFactory;
use Magento\Customer\Model\Session;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class Field extends Template
{
    /** @var AddressInterface */
    private $address;

    /** @var AddressRepositoryInterface */
    private $addressRepository;

    /** @var AddressInterfaceFactory */
    private $addressFactory;

    /** @var Session */
    private $customerSession;
    /**
     * @return Field
     * @throws LocalizedException
     */

    /**
     * @param Context $context
     * @param AddressRepositoryInterface $addressRepository
     * @param AddressInterfaceFactory $addressFactory
     * @param Session $customerSession
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        AddressRepositoryInterface $addressRepository,
        AddressInterfaceFactory $addressFactory,
        Session $customerSession,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->addressRepository = $addressRepository;
        $this->addressFactory = $addressFactory;
        $this->customerSession = $customerSession;
    }
    protected function _prepareLayout()
    {
        $addressId = $this->getRequest()->getParam('id');
        if ($addressId) {
            try {
                $this->address = $this->addressRepository->getById($addressId);
                if ($this->address->getCustomerId() !== $this->customerSession->getCustomerId()) {
                    $this->address = null;
                }
            } catch ( NoSuchEntityException $exception) {
                $this->address = null;
            }
        }
        if (null === $this->address) {
            $this->address = $this->addressFactory->create();
        }
        return parent::_prepareLayout();
    }

    /**
     * @return string
     * @throws LocalizedException
     */
    protected function _toHtml()
    {
        $widgetBlock = $this->getLayout()->createBlock(
            'Epam\Customer\Block\Customer\Address\Form\Edit\Widget\Field',
            'widget_custom_filed'
        );
        $widgetBlock->setAddress($this->address);
        return $widgetBlock->toHtml();
    }
}
