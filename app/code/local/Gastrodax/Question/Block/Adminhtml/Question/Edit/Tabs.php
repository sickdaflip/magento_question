<?php

class Gastrodax_Question_Block_Adminhtml_Question_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs {

    public function __construct() {
        parent::__construct();
        $this->setId('question_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('question')->__('Item Information'));
    }

    protected function _beforeToHtml() {
        $this->addTab('form_section', array(
            'label' => Mage::helper('question')->__('Item Information'),
            'title' => Mage::helper('question')->__('Item Information'),
            'content' => $this->getLayout()->createBlock('question/adminhtml_question_edit_tab_form')->toHtml(),
        ));

        return parent::_beforeToHtml();
    }

}