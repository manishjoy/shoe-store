<?php

class Excellence_Addnumber_Model_Customer_Resource_Customer extends Mage_Customer_Model_Resource_Customer
{
    public function loadByPhone($phone)
    { // echo  $no;
        $customer = Mage::getModel('customer/customer');
        $collection = $customer->getCollection()->addAttributeToFilter('phone', $phone)->getData();
        $arr = $collection;
        foreach($collection as $cll) { $email = $cll['email']; }
        return $email;
    }
}
