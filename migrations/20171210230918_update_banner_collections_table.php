<?php


use Phinx\Migration\AbstractMigration;

class UpdateBannerCollectionsTable extends AbstractMigration
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
        $table = $this->table('banner_collections');
        $table
            ->addColumn('advert_credit_id', 'integer', ['limit' => 11, 'null' => false])
            ->addForeignKey('advert_credit_id', 'advert_credit', 'advert_credit_id', ['update' => 'CASCADE'])
            ->update();

    }
}
