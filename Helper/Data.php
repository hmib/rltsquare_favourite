<?php

namespace RLTSquare\Favorite\Helper;

use \Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{
	protected $_modelFavoriteFactory;	

	
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
		\RLTSquare\Favorite\Model\FavoriteFactory $modelFavoriteFactory
    ) 
    {
        parent::__construct($context);   
		$this->_modelFavoriteFactory = $modelFavoriteFactory;
    }
	
	public function productIsFavoriteByCustomer($productId, $customerId)
	{
		$likeUnlikeModel = $this->_modelFavoriteFactory->create();
		$collectionFiltered = $likeUnlikeModel->getCollection()
						->addFieldToFilter('product_id',$productId)
						->addFieldToFilter('customer_id',$customerId);
             
		if(count($collectionFiltered) < 1){
			return true;
		}
		
		return false;				
	}

	
	
	public function getLikeUrl()
    {
        return $this->_getUrl('favorite/index/add');
    }
	
	public function getUnlikeUrl()
    {
        return $this->_getUrl('favorite/index/remove');
    }
	
	


}