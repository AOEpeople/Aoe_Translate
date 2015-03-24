<?php

class Aoe_Translate_Helper_Data extends Mage_Core_Helper_Abstract
{
    const XML_PATH_LOG_LEVEL = 'dev/aoe_translate/log_level';
    const STATUS_DISABLED = 0;
    const STATUS_MISSED = 1;
    const STATUS_UNSCOPED = 2;
    const STATUS_SCOPED = 3;

    /**
     * @param string $module
     * @param string $text
     * @param string $translation
     * @param int    $status
     *
     * @return $this
     */
    public function logTranslation($module, $text, $translation, $status)
    {
        $status = intval($status);
        if (intval(Mage::getStoreConfig(self::XML_PATH_LOG_LEVEL)) < $status) {
            return $this;
        }

        $storeId = Mage::app()->getStore()->getId();
        $localCode = Mage::app()->getLocale()->getLocaleCode();

        /** @var Aoe_Translate_Model_Log $log */
        $log = Mage::getSingleton('aoe_translate/log');

        /** @var Varien_Db_Adapter_Interface $connection */
        $connection = $log->getCollection()->getConnection();

        $connection->insertOnDuplicate(
            $log->getResource()->getMainTable(),
            array(
                'store_id'    => $storeId,
                'locale'      => $localCode,
                'module'      => $module,
                'source'      => $text,
                'translation' => $translation,
                'status'      => $status
            ),
            array(
                'translation',
                'status'
            )
        );

        return $this;
    }
}
