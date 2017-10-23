<?php

    namespace RLTSquare\Favorite\Controller\Index;
use Magento\Framework\Controller\ResultFactory;

class Remove extends \Magento\Framework\App\Action\Action 
{
	
	protected $_modelLikeunlikeFactory;
	
	private $resultJsonFactory;
	
	public function __construct( 
		\Magento\Framework\App\Action\Context $context,
		\RLTSquare\Favorite\Model\FavoriteFactory $modelLikeunlikeFactory,
		\Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
	)
    {
		parent::__construct($context);
		$this->_modelLikeunlikeFactory = $modelLikeunlikeFactory;
		$this->resultJsonFactory = $resultJsonFactory;
    }
	
	public function execute() {
		
		$productId = $this->getRequest()->getParam('id');
		
		$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
		$customerSession = $objectManager->create('Magento\Customer\Model\Session');
		$customerId = $customerSession->getCustomer()->getId();
				
		if( isset($productId) AND isset($customerId) ){
			$likeUnlikeModel = $this->_modelLikeunlikeFactory->create();
			
			$collectionFiltered = $likeUnlikeModel->getCollection()
									->addFieldToFilter('product_id', $productId)
									->addFieldToFilter('customer_id', $customerId)
									->getFirstItem();
			$collectionFiltered->delete();
                          $messageManager = $objectManager->get('Magento\Framework\Message\ManagerInterface');
                $messageManager->addSuccess(
                    __('Item has been removed from favorite list.'));
			
		}else{
			    $messageManager = $objectManager->get('Magento\Framework\Message\ManagerInterface');
             $messageManager->addSuccess(__("Please login/create account to add item in to favorite list."));

             $resultRedirect = $this->resultRedirectFactory->create();
             $resultRedirect->setPath('customer/account/login');
             return $resultRedirect;
		}
				
		$resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        // Your code

        $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        return $resultRedirect;
			
	}
	
	
}
