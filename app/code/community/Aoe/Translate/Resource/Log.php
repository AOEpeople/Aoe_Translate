<?php

class Aoe_Translate_Resource_Log extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * Resource initialization
     */
    protected function _construct()
    {
        $this->_init('aoe_translate/log', 'log_id');
    }
}
