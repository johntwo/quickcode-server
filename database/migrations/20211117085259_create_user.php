<?php

use think\migration\Migrator;
use think\migration\db\Column;

class CreateUser extends Migrator
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
        $table = $this->table("user",['comment'=>'用户','engine'=>'Innodb','collation'=>'utf8mb4_general_ci']);
        // 表必备字段
        $table->addColumn(Column::string('uuid')->setLimit(32)->setComment('唯一编号'));
        $table->addColumn(Column::integer('creator')->setLimit(11)->setComment('创建者id'));
        $table->addColumn(Column::integer('updater')->setLimit(11)->setComment('更新者id'));
        $table->addColumn(Column::timestamp('create_time')->setDefault('CURRENT_TIMESTAMP')->setComment('创建时间'));
        $table->addColumn(Column::timestamp('update_time')->setDefault('CURRENT_TIMESTAMP')->setUpdate('CURRENT_TIMESTAMP')->setComment('修改时间'));
        $table->addSoftDelete();
        // 业务字段
        $table->addColumn(Column::string('username')->setLimit(50)->setComment('用户名'));
        $table->addColumn(Column::string('nickname')->setLimit(50)->setComment('用户昵称'));
        $table->addColumn(Column::string('password')->setLimit(100)->setComment('用户登录密码'));
        $table->addColumn(Column::char('phone')->setLimit(11)->setDefault('')->setComment('手机号码'));
        $table->addColumn(Column::char('email')->setLimit(50)->setDefault('')->setComment('邮箱'));
        $table->addColumn(Column::tinyInteger('sex')->setLimit(1)->setDefault(0)->setComment('性别，0-无性别|1-男|2-女'));
        $table->addColumn(Column::string('wxopenid')->setLimit(50)->setDefault('')->setComment('微信openid'));
        $table->addColumn(Column::string('wxunionid')->setLimit(50)->setDefault('')->setComment('微信openid'));
        $table->create();
    }
}
