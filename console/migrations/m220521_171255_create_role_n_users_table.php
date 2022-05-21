<?php

use yii\db\Migration;
use yii\db\Schema;

class m220521_171255_create_role_n_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('role', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL'
        ]);
        $this->createTable('user', [
            'id' => Schema::TYPE_PK,
            'role_id' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 1', 
            'nickname' => Schema::TYPE_STRING . ' NOT NULL',
            'email' => Schema::TYPE_STRING . ' NOT NULL',
            'password' => Schema::TYPE_STRING . ' NOT NULL',
            'image' => Schema::TYPE_STRING . ' NOT NULL'
        ]);
        $this->createIndex(
            'idx-user-role_id',
            'user',
            'role_id'
        );
        $this->addForeignKey(
            'fk-user-role_id',
            'user',
            'role_id',
            'role',
            'id',
            'CASCADE'
        );
        $this->insert('role', [
            'name' => 'admin'
        ]);
        $this->insert('role', [
            'name' => 'user'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-user-role_id',
            'user'
        );
        $this->dropIndex(
            'idx-user-role_id',
            'user'
        );
        $this->dropTable('user');
        $this->dropTable('role');   
    }
}
