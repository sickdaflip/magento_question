<?php

class Gastrodax_Question_Model_Question extends Mage_Core_Model_Abstract {

    public function _construct() {
        parent::_construct();
        $this->_init('question/question');
    }

}