<?php
 
namespace RLTSquare\Favorite\Model\Resource;
 
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
 
class Favorite extends AbstractDb
{
	/**
	 * Define main table
	 */
	protected function _construct()
	{
		$this->_init('rlts_favorite', 'id');
	}
}