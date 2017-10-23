<?php
 
namespace RLTSquare\Favorite\Model\Resource\Favorite;
 
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
 
class Collection extends AbstractCollection
{
	/**
	 * Define model & resource model
	 */
	protected function _construct()
	{
		$this->_init(
			'RLTSquare\Favorite\Model\Favorite',
			'RLTSquare\Favorite\Model\Resource\Favorite'
		);
	}
}