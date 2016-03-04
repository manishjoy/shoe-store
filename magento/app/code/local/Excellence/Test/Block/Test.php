<?php
class Excellence_Test_Block_Test extends Mage_Core_Block_Template
{
    public function __construct()
    {
        parent::__construct();
        $collection = Mage::getModel('test/test')->showData();
        //echo $collection->getSize();
        $this->setCollection($collection);
    }
    public function _prepareLayout()
    {
        parent::_prepareLayout();
        $pager = $this->getLayout()->createBlock('page/html_pager', 'custom.pager');
        $pager->setAvailableLimit(array(5=>5,10=>10,20=>20,'all'=>'all'));
        $pager->setCollection($this->getCollection());
        $this->setChild('pager', $pager);
        $this->getCollection()->load();
        return $this;
    }

    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }
    


    public function getTest()     
    { 
        if (!$this->hasData('test')) {
            $this->setData('test', Mage::registry('test'));
        }
        return $this->getData('test');
        
    }
    
    public function showTable($module){
        $limit = Mage::app()->getRequest()->getParam("limit");
        $page = Mage::app()->getRequest()->getParam("p");
        $data = Mage::getModel('test/test')->showData($limit,$page);
        return $data;
    }
    public function getEditUrl($module_name, $row_id){
        return Mage::getUrl('test/index/edit', array('module_name' => $module_name, 'id'=>$row_id));
    }

    public function getDeleteUrl($module_name, $row_id){
        return Mage::getUrl('test/index/delete', array('module_name' => $module_name, 'id'=>$row_id));
    }

    public function getAddUrl($module_name){
        return Mage::getUrl('test/index/add', array('module_name' => $module_name));
    }
    public function getAdminData()
    {
        $data = array(Mage::getStoreConfig('testsection/test/name', Mage::app()->getStore()), 
                    Mage::getStoreConfig('testsection/test/patient', Mage::app()->getStore()),
                    Mage::getStoreConfig('testsection/test/slider', Mage::app()->getStore()));
        // $data[0] = Mage::getStoreConfig('testsection/test/name', Mage::app()->getStore());
        // $data[1] = Mage::getStoreConfig('testsection/test/patient', Mage::app()->getStore());
        // $data = Mage::getStoreConfig('testsection/test/patient', Mage::app()->getStore());
        return $data;
    }
}