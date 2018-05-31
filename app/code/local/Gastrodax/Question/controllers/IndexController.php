<?php

class Gastrodax_Question_IndexController extends Mage_Core_Controller_Front_Action {

    public function indexAction() {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function postAction()
    {
        $post = $this->getRequest()->getPost();
        if ($post) {
            try {
                $postObject = new Varien_Object();
                $postObject->setData($post);

                $error = false;

                if (!Zend_Validate::is(trim($post['customer_name']), 'NotEmpty')) {
                    $error = true;
                }

                if (!Zend_Validate::is(trim($post['customer_email']), 'EmailAddress')) {
                    $error = true;
                }

                if (Zend_Validate::is(trim($post['dsgvo']), 'NotEmpty')) {
                    $error = true;
                }

                if ($error) {
                    throw new Exception();
                }
                $request_model = Mage::getModel('question/question');
                $request_model->setData($post);
                $request_model->setCreatedTime(now());
                $request_model->save();
                $this->notifyAdmin($post);
                $message = 'We thank you for forwarding your question. We would touch base at the earliest.';
                Mage::getSingleton('core/session')->addSuccess(Mage::helper('question')->__($message));
                $wbrl = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB);
                $wcrl = str_ireplace($wbrl, "", $post['wcrl']);
                $this->_redirect($wcrl);
                return;
            } catch (Exception $e) {
                Mage::getSingleton('core/session')->addError(Mage::helper('question')->__('There are some errors in your form.'));
                $wbrl = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB);
                $wcrl = str_ireplace($wbrl, "", $post['wcrl']);
                $this->_redirect($wcrl);
                return;
            }
        }
    }

    private function notifyAdmin($post) {
        $mailSubject = 'Product Question';
        $adminEmail = Mage::getStoreConfig('trans_email/ident_general/email');
        $adminName = Mage::getStoreConfig('trans_email/ident_general/name');
        $storeName = Mage::app()->getStore()->getName();
        $vars = array('customerName' => $post['customer_name'],
            'customerEmail' => $post['customer_email'],
            'sku' => $post['sku'],
            'comment' => $post['comment'],
            'adminName' => $adminName,
            'storeName' => $storeName
        );

        $emailTemplate = Mage::getModel('core/email_template');
        $emailTemplate->loadDefault('question_notification_admin');
        $emailTemplate->setTemplateSubject($mailSubject);
        $emailTemplate->setSenderName($post['customer_name']);
        $emailTemplate->setSenderEmail($post['customer_email']);
        $emailTemplate->send($adminEmail, $storeName, $vars);
    }

}