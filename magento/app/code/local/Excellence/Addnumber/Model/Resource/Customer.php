<?php

class Excellence_Addnumber_Model_Resource_Customer extends Mage_Customer_Model_Resource_Customer
{
    public function loadByPhone($phone)
    { 
        $customer = Mage::getModel('customer/customer');
        $collection = $customer->getCollection()->addAttributeToFilter('phone', $phone)->getFirstItem();
       	return $collection['email'];
    }
    protected function _beforeSave(Varien_Object $customer)
    {
    	$phone = Mage::app()->getRequest()->getPost('phone');
        $customerr = Mage::getModel('customer/customer');
        $collection = $customerr->getCollection()->addAttributeToFilter('phone', $phone)->getFirstItem();
        if(!empty($collection['email'])){
            throw Mage::exception(
                'Mage_Customer', Mage::helper('customer')->__('This customer phone number already exists'),
                Mage_Customer_Model_Customer::EXCEPTION_EMAIL_NOT_CONFIRMED
            );
        }
        return parent::_beforeSave($customer);
    }
}
