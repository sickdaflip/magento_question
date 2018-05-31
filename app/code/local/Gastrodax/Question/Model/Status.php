<?php

class Gastrodax_Question_Model_Status extends Varien_Object {

    const STATUS_OPEN = "OPEN";
    const STATUS_HOLD = "HOLD";
    const STATUS_CLOSED = "CLOSED";

    static public function getOptionArray() {
        return array(
            self::STATUS_OPEN => Mage::helper('question')->__('Open'),
            self::STATUS_HOLD => Mage::helper('question')->__('Hold'),
            self::STATUS_CLOSED => Mage::helper('question')->__('Closed')
        );
    }

}