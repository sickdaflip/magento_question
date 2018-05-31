<?php

class Gastrodax_Question_Block_Adminhtml_Question_Edit extends Mage_Adminhtml_Block_Widget_Form_Container {

    public function __construct() {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'question';
        $this->_controller = 'adminhtml_question';

        $this->_updateButton('save', 'label', Mage::helper('question')->__('Save'));
        $this->_updateButton('delete', 'label', Mage::helper('question')->__('Delete'));

        $this->_addButton('saveandcontinue', array(
            'label' => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick' => 'saveAndContinueEdit()',
            'class' => 'save',
                ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('question_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'question_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'question_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText() {
        if (Mage::registry('question_data') && Mage::registry('question_data')->getId()) {
            return Mage::helper('question')->__("Edit Item", $this->htmlEscape(Mage::registry('question_data')->getTitle()));
        } else {
            // return Mage::helper('question')->__('Add Item');
        }
    }

}