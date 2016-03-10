<?php
class Excellence_Addnumber_Model_Customer_Customer extends Mage_Customer_Model_Customer
{
    public function authenticate($login, $password)
    {
        if(filter_var($login, FILTER_VALIDATE_EMAIL))
        {
            $this->loadByEmail($login);
            
        }
        else
        {   
            $email = $this->getResource()->loadByPhone($login);
            $this->loadByEmail($email);
        }
        // $this->loadByEmail($login);
        if ($this->getConfirmation() && $this->isConfirmationRequired()) {
            throw Mage::exception('Mage_Core', Mage::helper('customer')->__('This account is not confirmed.'),
                self::EXCEPTION_EMAIL_NOT_CONFIRMED
            );
        }
        if (!$this->validatePassword($password)) {
            throw Mage::exception('Mage_Core', Mage::helper('customer')->__('Invalid login or password.'),
                self::EXCEPTION_INVALID_EMAIL_OR_PASSWORD
            );
        }
        Mage::dispatchEvent('customer_customer_authenticated', array(
           'model'    => $this,
           'password' => $password,
        ));

        return true;
    }
}

?>