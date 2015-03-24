<?php

class Aoe_Translate_Test_Helper_Data extends EcomDev_PHPUnit_Test_Case
{
    /**
     * @test
     * @coversNothing
     */
    public function checkLoader()
    {
        /** @var Aoe_Translate_Helper_Data $helper */
        $helper = Mage::helper('aoe_translate');
        $this->assertInstanceOf('Aoe_Translate_Helper_Data', $helper);

        /** @var Aoe_Translate_Helper_Data $helper */
        $helper = Mage::helper('aoe_translate/data');
        $this->assertInstanceOf('Aoe_Translate_Helper_Data', $helper);
    }
}
