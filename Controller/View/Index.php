<?php

namespace RLTSquare\Favorite\Controller\View;

class Index extends \Magento\Framework\App\Action\Action 
{
	
	protected $_modelLikeunlikeFactory;
	
	private $resultJsonFactory;
	    protected $_resultPageFactory;
	public function __construct( 
		\Magento\Framework\App\Action\Context $context,
		\RLTSquare\Favorite\Model\FavoriteFactory $modelLikeunlikeFactory,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory
	)
    {
		parent::__construct($context);
		$this->_modelLikeunlikeFactory = $modelLikeunlikeFactory;
		  $this->_resultPageFactory = $resultPageFactory;
    }
	
	public function execute() {
		$resultPage = $this->_resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->set(__('Favorite List')); //for browser tab title
        return $resultPage;
		
			
	}
	
	
	
}
