<?php


use Phinx\Migration\AbstractMigration;

class CreateAdvertCreditTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $table = $this->table('advert_credit', ['id' => false, 'primary_key' => ['advert_credit_id']]);
        $table
            ->addColumn('advert_credit_id', 'integer', ['length' => 11, 'identity' => true, 'signed' => false])
            ->addColumn('value', 'integer', ['length' => 20, 'null' => false])
            ->addColumn('amount', 'decimal', ['scale' => 2, 'precision' => 15, 'default' => 0.00, 'null' => false])
            ->addColumn('status', 'enum', ['values' => ['enabled','disabled'], 'default' => 'enabled'])
            ->addColumn('created_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP', 'null' => true])
            ->create();

        $table
            ->addIndex(['advert_credit_id'])
            ->update();

    }
}
