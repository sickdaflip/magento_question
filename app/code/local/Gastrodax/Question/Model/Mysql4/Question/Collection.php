<?php

class Gastrodax_Question_Model_Mysql4_Question_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract {

    public function _construct() {
        parent::_construct();
        $this->_init('question/question');
    }

}