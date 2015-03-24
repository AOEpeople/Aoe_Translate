<?php

class Aoe_Translate_Test_Resource_Log extends EcomDev_PHPUnit_Test_Case
{
    /**
     * @test
     * @coversNothing
     */
    public function checkLoader()
    {
        /** @var Aoe_Translate_Resource_Log $resource */
        $resource = Mage::getResourceModel('aoe_translate/log');
        $this->assertInstanceOf('Aoe_Translate_Resource_Log', $resource);

        /** @var Aoe_Translate_Resource_Log $resource */
        $resource = Mage::getModel('aoe_translate/log')->getResource();
        $this->assertInstanceOf('Aoe_Translate_Resource_Log', $resource);
    }
}
