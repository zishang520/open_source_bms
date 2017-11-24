<?php

use think\migration\db\Column;
use think\migration\Migrator;

class UploadImages extends Migrator
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
        $table = $this->table('upload_images', ['comment' => '上传附件']);
        $table->addColumn('original', 'string', ['limit' => 255, 'null' => true, 'default' => null, 'comment' => '原始名称'])
            ->addColumn('file_name', 'string', ['limit' => 255, 'null' => true, 'default' => null, 'comment' => '文件名称'])
            ->addColumn('file_type', 'string', ['limit' => 100, 'null' => true, 'default' => null, 'comment' => '文件类型'])
            ->addColumn('hash', 'string', ['limit' => 255, 'comment' => '文件hash'])
            ->addColumn('url', 'string', ['limit' => 300, 'null' => true, 'default' => null, 'comment' => '网路地址'])
            ->addColumn('path', 'string', ['limit' => 300, 'comment' => '文件全路径地址'])
            ->addColumn('size', 'biginteger', ['signed' => true, 'default' => 0, 'comment' => '文件大小'])
            ->addColumn('created_at', 'timestamp', ['comment' => '创建时间'])
            ->addIndex(['hash', 'file_name'])
            ->save();
    }
}
