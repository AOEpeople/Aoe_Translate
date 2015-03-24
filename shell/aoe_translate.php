<?php

require_once 'abstract.php';

class Aoe_Translate_Shell_Translate extends Mage_Shell_Abstract
{

    public function generateStoreTranslationsAction()
    {
        /** @var Mage_Core_Model_Resource $resource */
        $resource = Mage::getSingleton('core/resource');
        $read = $resource->getConnection('core_read');
        $table = $resource->getTableName('core/translate');
        $value = $read->query(
            "SELECT CAST(`string` AS BINARY) AS s FROM `{$table}` AS `ct` WHERE `ct`.`store_id` != 0 GROUP BY s"
        );

        $strings = $value->fetchAll();
        $storeIds = $this->getArg('storeIds');
        if (!empty($storeIds)) {
            $storeIds = $this->trimExplode(',', $storeIds, true);
        } else {
            $storeIds = array_keys(Mage::app()->getStores());
        }

        /* @var Mage_Core_Helper_Data $helper */
        $helper = Mage::helper('core');

        /* @var Mage_Core_Model_Resource_Translate_String $resource */
        $resource = Mage::getResourceModel('core/translate_string');
        foreach ($storeIds as $storeId) {
            /* @var Mage_Core_Model_App $app */
            $app = Mage::app();
            $locale = $app->getLocale();

            $app->setCurrentStore($storeId);
            $locale->setLocale(Mage::getStoreConfig(Mage_Core_Model_Locale::XML_PATH_DEFAULT_LOCALE));
            $app->getTranslator()->setLocale($locale->getLocaleCode());
            $app->getTranslator()->init('frontend', true);

            foreach ($strings as $string) {
                $resource->saveTranslate($string['string'], $helper->__($string['string']));
            }
        }
    }

    public function generateStoreTranslationsActionHelp()
    {
        return ' [-storeIds <csl of store ids, defaults to all stores>]';
    }

    /**
     * Run script
     */
    public function run()
    {
        $action = $this->getArg('action');
        if (empty($action)) {
            echo $this->usageHelp();
        } else {
            $actionMethodName = $action . 'Action';
            if (method_exists($this, $actionMethodName)) {
                $this->$actionMethodName();
            } else {
                echo "Action $action not found!\n";
                echo $this->usageHelp();
                exit(1);
            }
        }
    }

    /**
     * Retrieve Usage Help Message
     *
     * @return string
     */
    public function usageHelp()
    {
        $help = 'Available actions: ' . "\n";
        $methods = get_class_methods($this);
        foreach ($methods as $method) {
            if (substr($method, -6) == 'Action') {
                $help .= '    -action ' . substr($method, 0, -6);
                $helpMethod = $method . 'Help';
                if (method_exists($this, $helpMethod)) {
                    $help .= $this->$helpMethod();
                }
                $help .= "\n";
            }
        }
        return $help;
    }

    /**
     * trim explode
     *
     * @param      $delim
     * @param      $string
     * @param bool $removeEmptyValues
     *
     * @return array
     */
    public function trimExplode($delim, $string, $removeEmptyValues = false)
    {
        $explodedValues = explode($delim, $string);
        $result = array_map('trim', $explodedValues);
        if ($removeEmptyValues) {
            $temp = array();
            foreach ($result as $value) {
                if ($value !== '') {
                    $temp[] = $value;
                }
            }
            $result = $temp;
        }
        return $result;
    }
}

$shell = new Aoe_Translate_Shell_Translate();
$shell->run();
