<?php

class Gastrodax_Question_Block_Question extends Mage_Core_Block_Template {

    public function _prepareLayout() {
        return parent::_prepareLayout();
    }

    public function getWeb() {
        if (!$this->hasData('question')) {
            $this->setData('question', Mage::registry('question'));
        }
        return $this->getData('question');
    }

}