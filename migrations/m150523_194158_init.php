<?php

use yii\db\Schema;
use yii\db\Migration;

class m150523_194158_init extends Migration
{
    public function safeUp()
    {
         return $this->createTable('user', [
            'id'           => Schema::TYPE_PK,
            'email'        => Schema::TYPE_STRING,
            'password'     => Schema::TYPE_STRING,
            'name'         => Schema::TYPE_STRING,
            'created_at'   => Schema::TYPE_INTEGER,
            'updated_at'   => Schema::TYPE_INTEGER
        ]);

    }
    
    public function safeDown()
    {
        return $this->dropTable('user');
    }
}
