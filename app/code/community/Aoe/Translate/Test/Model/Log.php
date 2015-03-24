<?php

class Aoe_Translate_Test_Model_Log extends EcomDev_PHPUnit_Test_Case
{
    /**
     * @test
     * @coversNothing
     */
    public function checkLoader()
    {
        /** @var Aoe_Translate_Model_Log $model */
        $model = Mage::getModel('aoe_translate/log');
        $this->assertInstanceOf('Aoe_Translate_Model_Log', $model);
    }
}
