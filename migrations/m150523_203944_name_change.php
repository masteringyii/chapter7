<?php

use yii\db\Schema;
use yii\db\Migration;

class m150523_203944_name_change extends Migration
{
    public function safeUp()
    {
        $users = \Yii::$app->db
                           ->createCommand('SELECT * FROM user')
                           ->queryAll();
              
        $this->dropTable('user');
        
        $this->createTable('user', [
            'id'           => Schema::TYPE_PK,
            'email'        => Schema::TYPE_STRING . ' NOT NULL',
            'password'     => Schema::TYPE_STRING . ' NOT NULL',
            'first_name'   => Schema::TYPE_STRING,
            'last_name'    => Schema::TYPE_STRING,
            'created_at'   => Schema::TYPE_INTEGER,
            'updated_at'   => Schema::TYPE_INTEGER
        ]);
        
        $this->createIndex('user_unique_email', 'user', 'email', true);

        foreach ($users as $user)
        {
            $this->insert('user', [
                'id'         => $user['id'],
                'email'      => $user['email'],
                'password'   => $user['password'],
                'first_name' => $user['name'],
                'created_at' => $user['created_at'],
                'updated_at' => $user['updated_at']
            ]);
        }
        
        /**
         * SQLite doesn't support these methods direclty
        $this->renameColumn('user', 'name', 'first_name');
        $this->alterColumn('user', 'first_name', SCHEMA::TYPE_STRING);
        $this->addColumn('user', 'last_name', SCHEMA::TYPE_STRING);
        $this->alterColumn('user', 'email', SCHEMA::TYPE_STRING . ' NOT NULL');
        $this->createIndex('user_unique_email', 'user', 'email', true);
        */
    }
    
    public function safeDown()
    {
        return true;
    }
}
