<?php

class Aoe_Translate_Resource_Log_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    /**
     * Resource constructor
     *
     */
    protected function _construct()
    {
        $this->_init('aoe_translate/log');
    }
}
