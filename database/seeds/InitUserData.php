<?php

use think\migration\Seeder;

class InitUserData extends Seeder
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $table = $this->table('user');
        $table->insert([
            [
                'id'=>1,
                'uuid'=>'b71eb590478511ecb73f84a93842bd06',
                'creator'=>1,
                'updater'=>1,
                'username'=>'admin',
                'nickname'=>'超级管理员',
                'password'=>'$2y$10$SirAiO5S8zTbmSAJzm2iOuzeFj4qe8lvTBI58tPl1Z4NGl5KkqVEm',
                'create_time'=>'2021-11-17 17:06:56',
                'update_time'=>'2021-11-17 17:06:56'
            ]
        ])->save();
    }
}