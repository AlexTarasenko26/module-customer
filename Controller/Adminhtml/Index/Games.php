<?php
declare(strict_types=1);

namespace Epam\Customer\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultFactory;

class Games extends Action implements HttpPostActionInterface
{

    /**
     * ACL access restriction
     */
    const ADMIN_RESOURCE = 'Epam_Customer::grid';

    public function execute()
    {
        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}
