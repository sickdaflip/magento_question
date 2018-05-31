<?php

class Gastrodax_Question_Block_Adminhtml_Question extends Mage_Adminhtml_Block_Widget_Grid_Container {

    public function __construct() {
        $this->_controller = 'adminhtml_question';
        $this->_blockGroup = 'question';
        $this->_headerText = Mage::helper('question')->__('question');
        $this->setTemplate('widget/grid/container.phtml');  // use for disable add new button
        //$this->_addButtonLabel = Mage::helper('inquiry')->__('Add Item');
        //parent::__construct(); //comment for not display Add new Button
    }

}