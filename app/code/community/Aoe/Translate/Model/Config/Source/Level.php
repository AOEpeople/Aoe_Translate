<?php

class Aoe_Translate_Model_Config_Source_Level
{
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return array(
            array(
                'value' => Aoe_Translate_Helper_Data::STATUS_DISABLED,
                'label' => Mage::helper('aoe_translate')->__('Disabled')
            ),
            array(
                'value' => Aoe_Translate_Helper_Data::STATUS_MISSED,
                'label' => Mage::helper('aoe_translate')->__('Missed')
            ),
            array(
                'value' => Aoe_Translate_Helper_Data::STATUS_UNSCOPED,
                'label' => Mage::helper('aoe_translate')->__('Unscoped')
            ),
            array(
                'value' => Aoe_Translate_Helper_Data::STATUS_SCOPED,
                'label' => Mage::helper('aoe_translate')->__('Scoped')
            ),
        );
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toOptionHash()
    {
        $data = array();
        foreach ($this->toOptionArray() as $entry) {
            $data[$entry['value']] = $entry['label'];
        }
        return $data;
    }
}
