<?php
/* @var Mage_Core_Model_Resource_Setup $this */
$this->startSetup();

$table = $this->getConnection()->newTable($this->getTable('aoe_translate/log'));

$table->addColumn(
    'id',
    Varien_Db_Ddl_Table::TYPE_INTEGER,
    null,
    array(
        'identity' => true,
        'unsigned' => true,
        'nullable' => false,
        'primary'  => true,
    )
);
$table->addColumn(
    'store_id',
    Varien_Db_Ddl_Table::TYPE_SMALLINT,
    null,
    array(
        'unsigned' => true,
        'nullable' => false,
        'default'  => '0',
    ),
    'Store'
);
$table->addColumn(
    'locale',
    Varien_Db_Ddl_Table::TYPE_TEXT,
    20,
    array(
        'nullable' => false,
    ),
    'Locale'
);
$table->addColumn(
    'module',
    Varien_Db_Ddl_Table::TYPE_TEXT,
    255,
    array(
        'nullable' => true,
    )
);
$table->addColumn(
    'source',
    Varien_Db_Ddl_Table::TYPE_TEXT,
    255,
    array(
        'nullable' => false,
    )
);
$table->addColumn(
    'translation',
    Varien_Db_Ddl_Table::TYPE_TEXT,
    255,
    array()
);
$table->addColumn(
    'status',
    Varien_Db_Ddl_Table::TYPE_SMALLINT,
    null,
    array(
        'unsigned' => true,
        'nullable' => false,
        'default'  => 0,
    )
);

$table->addIndex(
    $this->getIdxName(
        'aoe_translate/log',
        array('store_id', 'locale', 'module', 'source'),
        Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE
    ),
    array('store_id', 'locale', 'module', 'source'),
    array('type' => Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE)
);

$table->addIndex(
    $this->getIdxName('aoe_translate/log', array('store_id')),
    array('store_id')
);

$table->addForeignKey(
    $this->getFkName('aoe_translate/log', 'store_id', 'core/store', 'store_id'),
    'store_id',
    $this->getTable('core/store'),
    'store_id',
    Varien_Db_Ddl_Table::ACTION_CASCADE,
    Varien_Db_Ddl_Table::ACTION_CASCADE
);

$this->getConnection()->createTable($table);

$this->endSetup();
