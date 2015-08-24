<?php

class Aoe_Translate_Model_Translate extends Mage_Core_Model_Translate
{

    const XML_PATH_MISSED_PATTERN = 'dev/aoe_translate/missed_pattern';

    /**
     * Return translated string from text.
     *
     * @param string $text
     * @param string $code
     *
     * @return string
     */
    protected function _getTranslatedString($text, $code)
    {
        $text = (string)$text;

        $module = explode(self::SCOPE_SEPARATOR, $code, 2);
        $module = reset($module);

        if (array_key_exists($code, $this->getData())) {
            $translated = $this->_data[$code];
            $status = Aoe_Translate_Helper_Data::STATUS_SCOPED;
        } elseif (array_key_exists($text, $this->getData())) {
            $translated = $this->_data[$text];
            $status = Aoe_Translate_Helper_Data::STATUS_UNSCOPED;
        } else {
            if ($pattern = Mage::getStoreConfig(self::XML_PATH_MISSED_PATTERN)) {
                $translated = sprintf($pattern, $text);
            } else {
                $translated = $text;
            }
            $status = Aoe_Translate_Helper_Data::STATUS_MISSED;
        }

        Mage::helper('aoe_translate')->logTranslation($module, $text, $translated, $status);

        return $translated;
    }


    /**
     * Loading current store translation from DB
     *
     * NB: This function fixes the parent by using a 'false' scope instead of the store ID
     * If we use a store scope, we can never override the theme translations
     *
     * NB: This function still will not ensure translations are preferred to scoped ones
     *
     * @param bool $forceReload
     *
     * @return $this
     */
    protected function _loadDbTranslation($forceReload = false)
    {
        $arr = $this->getResource()->getTranslationArray(null, $this->getLocale());
        $this->_addData($arr, false, $forceReload);

        return $this;
    }


    /**
     * Adding translation data
     *
     * @param array  $data
     * @param string $scope
     * @param bool   $forceReload
     *
     * @return $this
     */
    protected function _addData($data, $scope, $forceReload = false)
    {
        foreach ($data as $key => $value) {
            if ($key === $value) {
                continue;
            }
            $key = $this->_prepareDataString($key);
            $value = $this->_prepareDataString($value);
            if ($scope && isset($this->_dataScope[$key]) && !$forceReload) {
                // Copy the original un-scoped version to a scoped version
                // The first scoped version is the default un-scoped
                if ($this->_dataScope[$key] !== false) {
                    $scopeKey = $this->_dataScope[$key] . self::SCOPE_SEPARATOR . $key;
                    if (isset($this->_data[$key]) && !isset($this->_data[$scopeKey])) {
                        $this->_data[$scopeKey] = $this->_data[$key];
                        $this->_dataScope[$key] = false;
                    }
                }
                $scopeKey = $scope . self::SCOPE_SEPARATOR . $key;
                $this->_data[$scopeKey] = $value;
            } else {
                $this->_data[$key] = $value;
                $this->_dataScope[$key] = $scope;
            }
        }

        return $this;
    }
}
