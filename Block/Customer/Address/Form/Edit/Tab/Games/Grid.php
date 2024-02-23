<?php
declare(strict_types=1);

namespace Epam\Customer\Block\Customer\Address\Form\Edit\Tab\Games;

use Magento\Backend\Block\Widget\Grid\Extended;
use Magento\Backend\Block\Template\Context;
use Magento\Backend\Helper\Data;
use Epam\ComputerGames\Model\ResourceModel\Game\CollectionFactory;

class Grid extends Extended
{
    private CollectionFactory $collectionFactory;

    /**
     * @param Context $context
     * @param Data $backendHelper
     * @param CollectionFactory $collectionFactory
     * @param array $data
     */
    public function __construct(
        Context           $context,
        Data              $backendHelper,
        CollectionFactory $collectionFactory,
        array             $data = []
    )
    {
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context, $backendHelper, $data);
    }

    protected function _construct()
    {
        parent::_construct();
        $this->setDefaultSort('created_at', 'desc');
        $this->setSortable(false);
        $this->setPagerVisibility(false);
        $this->setFilterVisibility(false);
    }

    protected function _prepareGrid()
    {
        $this->setId('computer_games_customer_custom' . $this->getWebsiteId());
        parent::_prepareGrid();
    }

    protected function _prepareCollection()
    {
        $collection = $this->collectionFactory->create();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn(
            'game_id',
            [
                'header' => __('ID'),
                'index' => 'game_id',
                'type' => 'number'
            ]
        );
        $this->addColumn(
            'name',
            [
                'header' => __('Name'),
                'index' => 'name'
            ]
        );
        $this->addColumn(
            'type',
            [
                'header' => __('Type'),
                'index' => 'type'
            ]
        );
        $this->addColumn(
            'trial_period',
            [
                'header' => __('Trial Period'),
                'index' => 'trial_period'
            ]
        );
        $this->addColumn(
            'release_date',
            [
                'header' => __('Release Date'),
                'index' => 'release_date'
            ]
        );
        return parent::_prepareColumns();
    }
}
