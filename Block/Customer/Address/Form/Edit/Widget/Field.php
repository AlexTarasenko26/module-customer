<?php
declare(strict_types=1);

namespace Epam\Customer\Block\Customer\Address\Form\Edit\Widget;

use Magento\Customer\Api\AddressMetadataInterface;
use Magento\Customer\Api\Data\AddressInterface;
use Magento\Customer\Api\Data\AttributeMetadataInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Phrase;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class Field extends Template
{
    /** @var AddressMetadataInterface */
    private $addressMetaData;

    /**
     * @param Context $context
     * @param AddressMetadataInterface $addressMetaData
     * @param array $data
     */
    public function __construct(
        Template\Context         $context,
        AddressMetadataInterface $addressMetaData,
        array                    $data = [],
    )
    {
        parent::__construct($context, $data);
        $this->addressMetaData = $addressMetaData;
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('customer/address/form/widget/field.phtml');
    }


    /**
     * @return bool
     * @throws LocalizedException
     */
    public function isRequired()
    {
        return $this->getAttribute() && $this->getAttribute()->isRequired();
    }

    /**
     * @return AttributeMetadataInterface|null
     * @throws LocalizedException
     */
    private function getAttribute()
    {
        try {
            $attribute = $this->addressMetaData->getAttributeMetadata('custom');
        } catch (NoSuchEntityException $exception) {
            return null;
        }

        return $attribute;
    }

    /**
     * @return string|null
     */
    public function getValue()
    {
        /** @var AddressInterface $address */
        $address = $this->getAddress();
        if ($address instanceof AddressInterface) {
            return $address->getCustomAttribute('custom') ?
                $address->getCustomAttribute('custom')->getValue() : null;
        }
        return null;
    }

    /**
     * @return string
     */
    public function getFieldId()
    {
        return 'custom';
    }

    /**
     * @return string
     */
    public function getFieldName()
    {
        return 'custom';
    }

    /**
     * @return Phrase|string
     * @throws LocalizedException
     */
    public function getFieldLabel()
    {
        return $this->getAttribute()
            ? $this->getAttribute()->getFrontendLabel()
            :  __('Custom Field');
    }
}
