<?php

use yii\db\Schema;
use yii\db\Migration;

class m150523_203944_relational extends Migration
{
    public function safeUp()
    {
		// Users
        $this->createTable('user', [
            'id'           => Schema::TYPE_PK,
            'email'        => Schema::TYPE_STRING . ' NOT NULL',
            'password'     => Schema::TYPE_STRING . ' NOT NULL',
            'first_name'   => Schema::TYPE_STRING,
            'last_name'    => Schema::TYPE_STRING,
			'role_id' 	   => Schema::TYPE_INTEGER . ' DEFAULT 1',
            'created_at'   => Schema::TYPE_INTEGER,
            'updated_at'   => Schema::TYPE_INTEGER,
			'FOREIGN KEY(role_id) REFERENCES role(id)'
        ]);
        
        $this->createIndex('user_unique_email', 'user', 'email', true);

		// Roles
		$this->createTable('role', [
			'id' 		  => Schema::TYPE_PK,
			'name' 		  => Schema::TYPE_STRING
		]);

		// Posts
		$this->createTable('post', [
			'id' 		  => Schema::TYPE_PK,
			'title'		  => Schema::TYPE_STRING . ' NOT NULL',
			'slug'		  => Schema::TYPE_STRING . ' NOT NULL',
			'content'	  => Schema::TYPE_TEXT . ' NOT NULL',
			'author_id'   => Schema::TYPE_INTEGER,
            'created_at'   => Schema::TYPE_INTEGER,
            'updated_at'   => Schema::TYPE_INTEGER,
			'FOREIGN KEY(author_id) REFERENCES user(id)'
		]);

		// Insert some dummy data
	
		$this->batchInsert('role', ['id', 'name'], [
			[1, 'User'], [2, 'Admin']
		]);

		$this->batchInsert('user', ['id', 'email', 'password', 'first_name', 'last_name', 'role_id', 'created_at', 'updated_at'], [
			[1, 'jane.doe@example.com', password_hash('password1', PASSWORD_BCRYPT, ['cost' => 13]), 'Jane', 'Joe', 1, time(), time()],
			[2, 'john.doe@example.com', password_hash('password2', PASSWORD_BCRYPT, ['cost' => 13]), 'John', 'Joe', 1, time(), time()],
			[3, 'johnie.doe@example.com', password_hash('password3', PASSWORD_BCRYPT, ['cost' => 13]), 'Johnie', 'Joe', 1, time(), time()],
			[4, 'admin@example.com', password_hash('admin', PASSWORD_BCRYPT, ['cost' => 13]), 'Site', 'Administrator', 2, time(), time()]
		]);

		$this->batchInsert('post', ['title', 'slug', 'content', 'author_id', 'created_at', 'updated_at'], [
			['Lorem Ipsum', '/lorem-ipsum', 'Lorem Ipsum Example Post', 4, time(), time()],
			['Lorem Ipsum 2', '/lorem-ipsum-2', 'Lorem Ipsum Example Post 2', 4, time(), time()],
			['Lorem Ipsum 3', '/lorem-ipsum-3', 'Lorem Ipsum Example Post 3', 4, time(), time()],
		]);
    }
    
    public function safeDown()
 	{
		echo "m150523_203944 does not support down migrations\n";
        return false;
    }
}
