<?php
 
namespace RLTSquare\Favorite\Model;
 
use Magento\Framework\Model\AbstractModel;
 
class Favorite extends AbstractModel
{
	/**
	 * Define resource model
	 */
	protected function _construct()
	{
		$this->_init('RLTSquare\Favorite\Model\Resource\Favorite');
	}
}