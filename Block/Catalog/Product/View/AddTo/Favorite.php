<?php
namespace RLTSquare\Favorite\Block\Catalog\Product\View\AddTo;

class Favorite extends \Magento\Framework\View\Element\Template
{
    protected $_registry;
	
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,       
        \Magento\Framework\Registry $registry,
        array $data = []
    )
    {       
        $this->_registry = $registry;
        parent::__construct($context, $data);
    }

    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }
	
	
    public function getCurrentProduct()
    {       
	    return $this->_registry->registry('current_product');
    }   
	
	public function getCustomerSession(){
		$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
		$customerSession = $objectManager->create('Magento\Customer\Model\Session');
		return $customerSession;
	}
	
}
?>