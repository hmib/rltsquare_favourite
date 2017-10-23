<?php

namespace RLTSquare\Favorite\Controller\Index;
use Magento\Framework\Controller\ResultFactory;
class Add extends \Magento\Framework\App\Action\Action 
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
		
		$productId = $this->getRequest()->getparam('id');
		
		$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
		$customerSession = $objectManager->create('Magento\Customer\Model\Session');
		$customerId = $customerSession->getCustomer()->getId();
        $logged_in = $customerSession->isLoggedIn();

        $objDate = $objectManager->create('Magento\Framework\Stdlib\DateTime\DateTime');
		$date = $objDate->gmtDate();
                
		if($logged_in){
                    
            if( isset($productId) AND isset($customerId) ){
                $likeUnlikeModel = $this->_modelLikeunlikeFactory->create()->getCollection()->addFieldToFilter('product_id',$productId)->addFieldToFilter('customer_id',$customerId)->getFirstItem();
                $likeUnlikeModel->setData('product_id', $productId);
                $likeUnlikeModel->setData('customer_id', $customerId);
                $likeUnlikeModel->setData('created_at', $date);
                $likeUnlikeModel->save();
                            $messageManager = $objectManager->get('Magento\Framework\Message\ManagerInterface');
                $messageManager->addSuccess(
                    __('Added item on my favorite list.'));

            }
               
        }
        else{
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
