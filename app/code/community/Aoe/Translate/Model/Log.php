<?php

class Aoe_Translate_Model_Log extends Mage_Core_Model_Abstract
{
    protected $_eventPrefix = 'aoe_translate';
    protected $_eventObject = 'log';

    /**
     * Init resource model
     */
    protected function _construct()
    {
        $this->_setResourceModel('aoe_translate/log', 'aoe_translate/log_collection');
    }
}
