<?php

class Gastrodax_Question_Block_Adminhtml_Question_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {
        parent::__construct();
        $this->setId('questionGrid');
        $this->setDefaultSort('question_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection() {
        $collection = Mage::getModel('question/question')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {
        $this->addColumn('question_id', array(
            'header' => Mage::helper('question')->__('ID'),
            'align' => 'right',
            'index' => 'question_id',
        ));

        $this->addColumn('customer_id', array(
            'header' => Mage::helper('question')->__('Customer ID'),
            'align' => 'left',
            'index' => 'customer_id',
        ));

        $this->addColumn('customer_name', array(
            'header' => Mage::helper('question')->__('Name'),
            'align' => 'left',
            'index' => 'customer_name',
        ));

        $this->addColumn('customer_email', array(
            'header' => Mage::helper('question')->__('Email'),
            'align' => 'left',
            'index' => 'customer_email',
        ));

        $this->addColumn('sku', array(
            'header' => Mage::helper('question')->__('SKU'),
            'align' => 'left',
            'index' => 'sku',
        ));

        $this->addColumn('comment', array(
            'header' => Mage::helper('question')->__('Comment'),
            'index' => 'comment',
        ));

        $this->addColumn('dsgvo', array(
            'header' => Mage::helper('question')->__('DSGVO'),
            'align' => 'left',
            'index' => 'dsgvo',
        ));

        $this->addColumn('created_time', array(
            'header' => Mage::helper('question')->__('Date'),
            'width' => '130px',
            'index' => 'created_time',
        ));

        $this->addColumn('status', array(
            'header' => Mage::helper('question')->__('Status'),
            'align' => 'left',
            'width' => '80px',
            'index' => 'status',
            'type' => 'options',
            'options' => array(
                'OPEN' => 'Open',
                'HOLD' => 'Hold',
                'CLOSED' => 'Closed'
            ),
        ));

        $this->addColumn('action', array(
            'header' => Mage::helper('question')->__('Action'),
            'width' => '50px',
            'align' => 'center',
            'type' => 'action',
            'getter' => 'getId',
            'actions' => array(
                array(
                    'caption' => Mage::helper('question')->__('Edit'),
                    'url' => array('base' => '*/*/edit'),
                    'field' => 'id'
                )
            ),
            'filter' => false,
            'sortable' => false,
            'index' => 'stores',
            'is_system' => true,
        ));

        $this->addExportType('*/*/exportCsv', Mage::helper('question')->__('CSV'));
        $this->addExportType('*/*/exportXml', Mage::helper('question')->__('XML'));

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction() {
        $this->setMassactionIdField('question_id');
        $this->getMassactionBlock()->setFormFieldName('question');

        $this->getMassactionBlock()->addItem('delete', array(
            'label' => Mage::helper('question')->__('Delete'),
            'url' => $this->getUrl('*/*/massDelete'),
            'confirm' => Mage::helper('question')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('question/status')->getOptionArray();

        array_unshift($statuses, array('label' => '', 'value' => ''));
        $this->getMassactionBlock()->addItem('status', array(
            'label' => Mage::helper('question')->__('Change status'),
            'url' => $this->getUrl('*/*/massStatus', array('_current' => true)),
            'additional' => array(
                'visibility' => array(
                    'name' => 'status',
                    'type' => 'select',
                    'class' => 'required-entry',
                    'label' => Mage::helper('question')->__('Status'),
                    'values' => $statuses
                )
            )
        ));
        return $this;
    }

    public function getRowUrl($row) {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

}