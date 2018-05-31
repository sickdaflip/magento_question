<?php

class Gastrodax_Question_Block_Adminhtml_Question_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form {

    protected function _prepareForm() {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('question_form', array('legend' => Mage::helper('question')->__('Enquiry Status')));

        $fieldset->addField('status', 'select', array(
            'label' => Mage::helper('question')->__('Status'),
            'name' => 'status',
            'values' => array(
                array(
                    'value' => 'OPEN',
                    'label' => Mage::helper('question')->__('Open'),
                ),
                array(
                    'value' => 'HOLD',
                    'label' => Mage::helper('question')->__('Hold'),
                ),
                array(
                    'value' => 'CLOSED',
                    'label' => Mage::helper('question')->__('Closed'),
                ),
            ),
        ));

        $fieldset->addField('question_id', 'text', array(
            'label' => Mage::helper('question')->__('Enquiry ID'),
            'required' => false,
            'name' => 'question_id',
            'disabled' => 'disabled',
        ));

        $fieldset->addField('customer_id', 'text', array(
            'label' => Mage::helper('question')->__('Customer ID'),
            'required' => false,
            'name' => 'customer_id',
            'disabled' => 'disabled',
        ));

        $fieldset->addField('customer_name', 'text', array(
            'label' => Mage::helper('question')->__('Name'),
            'required' => false,
            'name' => 'customer_name',
            'disabled' => 'disabled',
        ));

        $fieldset->addField('customer_email', 'text', array(
            'label' => Mage::helper('question')->__('Email'),
            'required' => false,
            'name' => 'customer_email',
            'disabled' => 'disabled',
        ));

        $fieldset->addField('sku', 'text', array(
            'label' => Mage::helper('question')->__('SKU'),
            'required' => false,
            'name' => 'sku',
            'disabled' => 'disabled',
        ));

        $fieldset->addField('dsgvo', 'text', array(
            'label' => Mage::helper('question')->__('DSGVO'),
            'required' => false,
            'name' => 'dsgvo',
            'disabled' => 'disabled',
        ));

        $fieldset->addField('comment', 'editor', array(
            'name' => 'comment',
            'label' => Mage::helper('question')->__('Comment'),
            'title' => Mage::helper('question')->__('Comment'),
            'style' => 'width:700px; height:500px;',
            'wysiwyg' => false,
            'required' => false,
            'disabled' => 'disabled',
        ));

        if (Mage::getSingleton('adminhtml/session')->getWebData()) {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getWebData());
            Mage::getSingleton('adminhtml/session')->setWebData(null);
        } elseif (Mage::registry('question_data')) {
            $form->setValues(Mage::registry('question_data')->getData());
        }
        return parent::_prepareForm();
    }

}