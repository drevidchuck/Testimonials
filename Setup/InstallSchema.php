<?php namespace V3N0m21\Testimonials\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
	/**
     * Installs DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        $table = $installer->getConnection()
            ->newTable($installer->getTable('v3n0m21_testimonials_testimonial'))
            ->addColumn(
                'testimonial_id',
                Table::TYPE_SMALLINT,
                null,
                ['identity' => true, 'nullable' => false, 'primary' => true],
                'Testimonial ID'
            )
            ->addColumn('user_id', Table::TYPE_INTEGER, 10, ['unsigned' => true, 'nullable' => false], 'User that left testimonial')
            ->addColumn('title', Table::TYPE_TEXT, 255, ['nullable' => false], 'Testimonial Title')
            ->addColumn('content', Table::TYPE_TEXT, 65536, [], 'Testimonial Content')
            ->addColumn('is_active', Table::TYPE_SMALLINT, null, ['nullable' => false, 'default' => '1'], 'Is Testimonial Active?')
            ->addColumn('creation_time', Table::TYPE_DATETIME, null, ['nullable' => false], 'Creation Time')
            ->addColumn('update_time', Table::TYPE_DATETIME, null, ['nullable' => false], 'Update Time')
            ->addIndex($installer->getIdxName('testimonials_testimonial', ['testimonial_id']), ['testimonial_id'])
            ->addForeignKey($installer->getFkName(
                'v3n0m21_testimonials_testimonial',
                'user_id',
                'customer_entity',
                'entity_id'
            ),
            'user_id', $installer->getTable('customer_entity'), 'entity_id',
                \Magento\Framework\Db\Ddl\Table::ACTION_CASCADE)
            ->setComment('V3N0m21 Testimonials');

        $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }
}