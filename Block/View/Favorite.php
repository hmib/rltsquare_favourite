<?php

namespace RLTSquare\Favorite\Block\View;

class Favorite extends \Magento\Framework\View\Element\Template {

    protected $_modelfavoriteFactory;
    protected $_productsFactory;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Reports\Model\ResourceModel\Product\CollectionFactory $productsFactory
     * @param array $data
     */
    public function __construct(
    \Magento\Backend\Block\Template\Context $context, \RLTSquare\Favorite\Model\FavoriteFactory $modelfavoriteFactory, \Magento\Reports\Model\ResourceModel\Product\CollectionFactory $productsFactory
    ) {
        parent::__construct($context);
        $this->_productsFactory = $productsFactory;

        $this->_modelfavoriteFactory = $modelfavoriteFactory;
    }

    public function _prepareLayout() {
        return parent::_prepareLayout();
    }

    public function getCollection() {

        $currentStoreId = $this->_storeManager->getStore()->getId();

        $collection = $this->_productsFactory->create()
                        ->addAttributeToSelect(
                                '*'
                        )->addViewsCount()->setStoreId(
                        $currentStoreId
                )->addStoreFilter(
                $currentStoreId
        );

        $items = $collection;
        return $items;
    }

    public function getFavorites() {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $customerSession = $objectManager->get('Magento\Customer\Model\Session');
        $customerId = $customerSession->getCustomer()->getId();
      
        if ($customerId) {
            $favoriteModel = $objectManager->create('RLTSquare\Favorite\Model\Favorite');

            $collectionFiltered = $favoriteModel->getCollection()
                    ->addFieldToFilter('customer_id', $customerId);

            return $collectionFiltered;
        }
    }

    public function getCustomerSession() {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $customerSession = $objectManager->create('Magento\Customer\Model\Session');
        return $customerSession;
    }

 
}

?>