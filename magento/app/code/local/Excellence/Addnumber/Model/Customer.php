<?php
class Excellence_Addnumber_Model_Customer extends Mage_Customer_Model_Customer
{
    public function authenticate($login, $password)
    {
        if(filter_var($login, FILTER_VALIDATE_EMAIL))
        {
            // $this->loadByEmail($login);
            parent::authenticate($login, $password);
        }
        else
        {   
            $email = $this->getResource()->loadByPhone($login);
            parent::authenticate($email, $password);
        }

        return true;
    }
}

?>