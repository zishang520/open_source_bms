<?php

use app\common\model\AdminUser;
use think\migration\db\Column;
use think\migration\Migrator;

class Init extends Migrator
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

    public function up()
    {
        $sql = file_get_contents(ROOT_PATH . '/open_source_bms.sql');
        $this->execute($sql);
        (new AdminUser)->isUpdate(true)->save(['password' => 'admin'], ['username' => 'admin']);
    }
    public function down()
    {
    }
}
