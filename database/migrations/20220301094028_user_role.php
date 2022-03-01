<?php

use think\migration\Migrator;
use think\migration\db\Column;

class UserRole extends Migrator
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
        $table = $this->table("user_role",['comment'=>'用户角色','engine'=>'Innodb','collation'=>'utf8mb4_general_ci']);
        $table->addColumn(Column::integer('creator')->setLimit(11)->setComment('创建者id'));
        $table->addColumn(Column::integer('updater')->setLimit(11)->setComment('更新者id'));
        $table->addColumn(Column::timestamp('create_time')->setDefault('CURRENT_TIMESTAMP')->setComment('创建时间'));
        $table->addColumn(Column::timestamp('update_time')->setDefault('CURRENT_TIMESTAMP')->setUpdate('CURRENT_TIMESTAMP')->setComment('修改时间'));
        $table->addSoftDelete();
        // 业务字段
        $table->addColumn(Column::integer('uid')->setLimit(11)->setComment('用户id'));
        $table->addColumn(Column::integer('client')->setLimit(11)->setComment('用户端'));
        $table->addColumn(Column::integer('client_id')->setLimit(11)->setDefault(0)->setComment('用户端对应的业务id'));
        $table->addColumn(Column::json('roles')->setLimit(11)->setComment('角色id数组'));
        $table->create();
    }
}
