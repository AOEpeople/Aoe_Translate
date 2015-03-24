<?php

class Aoe_Translate_Test_Resource_Log_Collection extends EcomDev_PHPUnit_Test_Case
{
    /**
     * @test
     * @coversNothing
     */
    public function checkLoader()
    {
        /** @var Aoe_Translate_Resource_Log_Collection $resourceCollection */
        $resourceCollection = Mage::getResourceModel('aoe_translate/log_collection');
        $this->assertInstanceOf('Aoe_Translate_Resource_Log_Collection', $resourceCollection);

        /** @var Aoe_Translate_Resource_Log_Collection $resourceCollection */
        $resourceCollection = Mage::getModel('aoe_translate/log')->getCollection();
        $this->assertInstanceOf('Aoe_Translate_Resource_Log_Collection', $resourceCollection);

        /** @var Aoe_Translate_Resource_Log_Collection $resourceCollection */
        $resourceCollection = Mage::getModel('aoe_translate/log')->getResourceCollection();
        $this->assertInstanceOf('Aoe_Translate_Resource_Log_Collection', $resourceCollection);
    }
}
