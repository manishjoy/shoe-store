<?php
class Excellence_Test_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $this->loadLayout();     
        $this->renderLayout();
    }
    public function adminAction()
    {
        $this->loadLayout();     
        $this->renderLayout();
    }

    public function deleteAction()
    {
    	$this->loadLayout();
        $id = Mage::app()->getRequest()->getParam("id");
        $module_name = Mage::app()->getRequest()->getParam("module_name");
        if(Mage::getModel('test/'.$module_name)->deleteRow($id)){
            Mage::getSingleton('core/session')->addSuccess(Mage::helper('test')->__('Row Deleted'));
            $this->_redirect('test/index/index');
        }
        else{
            Mage::getSingleton('core/session')->addError(Mage::helper('test')->__('Some Error Occured.... Please try again...'));
        }     
        $this->renderLayout();
    }

    public function addAction()
    {
    	$this->loadLayout();
        $module_name = Mage::app()->getRequest()->getParam("module_name");
        $post = Mage::app()->getRequest()->getPost('row');
        if(isset($post['sub']) && !empty($post['title']) && !empty($post['content'])){
            if(Mage::getModel('test/'.$module_name)->saveRow($post)){
                $this->_redirect('test/index/index');
                Mage::getSingleton('core/session')->addSuccess(Mage::helper('test')->__('Row Inserted'));
                //$this->_redirect('test/index/index');
            }
            else{
                    Mage::getSingleton('core/session')->addError(Mage::helper('test')->__('Some Error Occured.... Please try again...'));
            }
        }
        else{
                Mage::getSingleton('core/session')->addNotice(Mage::helper('test')->__('Please Fill All The Fields Correctly'));
        }

        $this->renderLayout();
    }
    public function editAction()
    {
    	$this->loadLayout();
        $id = Mage::app()->getRequest()->getParam("id");
        $module_name = Mage::app()->getRequest()->getParam("module_name"); 

        //fetch & show data
    	Mage::register('id', $id);
    	$status = Mage::getModel('test/'.$module_name)->fetchBeforeEdit($id);
    	Mage::register('title', $status['title']); 
    	Mage::register('content', $status['content']); 
    	Mage::register('status', $status['status']);    

        //save data
        $row = Mage::app()->getRequest()->getPost('row');
        if(isset($row['sub']) && !empty($row['title']) && !empty($row['content'])){
            if(Mage::getModel('test/'.$module_name)->saveEdit($row, $id)){
                $this->_redirect('test/index/index');
                Mage::getSingleton('core/session')->addSuccess(Mage::helper('test')->__('Row Edited'));
            }
            else{
                Mage::getSingleton('core/session')->addError(Mage::helper('test')->__('Some Error Occured.... Please try again...'));
            }
        }
        else{
            Mage::getSingleton('core/session')->addNotice(Mage::helper('test')->__('Please Fill All The Fields Correctly'));
        }
        $this->renderLayout();
    }
}