<?php

class Aoe_Translate_Test_Model_Translate extends EcomDev_PHPUnit_Test_Case
{
    /**
     * @test
     * @coversNothing
     */
    public function checkLoader()
    {
        /** @var Aoe_Translate_Model_Translate $model */
        $model = Mage::getModel('aoe_translate/translate');
        $this->assertInstanceOf('Aoe_Translate_Model_Translate', $model);

        /** @var Aoe_Translate_Model_Translate $model */
        $model = Mage::getModel('core/translate');
        $this->assertInstanceOf('Aoe_Translate_Model_Translate', $model);
        $this->assertInstanceOf('Mage_Core_Model_Translate', $model);
    }
}
