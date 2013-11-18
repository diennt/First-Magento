<?php
/**
 * Created by JetBrains PhpStorm.
 * User: diennt
 * Date: 11/18/13
 * Time: 5:49 PM
 * To change this template use File | Settings | File Templates.
 */

class SM_FirstModule_Model_Observer
{
    const FLAG_SHOW_CONFIG = 'showConfig';
    const FLAG_SHOW_CONFIG_FORMAT = 'showConfigFormat';

    private $request;

    public function checkForConfigRequest($observer)
    {
        $this->request = $observer->getEvent()->getData('front')->getRequest();
        if ($this->request->{self::FLAG_SHOW_CONFIG} === 'true') {
            $this->setHeader();
            $this->outputConfig();
        }
    }

    private function setHeader()
    {
        $format = isset($this->request->{self::FLAG_SHOW_CONFIG_FORMAT}) ? $this->request->{self::FLAG_SHOW_CONFIG_FORMAT} : 'xml';
        switch($format) {
            case 'text' :
                header("Content-Type : text/plain");
                break;
            default :
                header("Content-Type : text/xml");
        }
    }

    private function outputConfig()
    {
        die(Mage::app()->getConfig()->getNode()->asXML());
    }
}