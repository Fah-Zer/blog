<?php

use yii\db\Migration;
use yii\db\Schema;

class m220521_171255_create_database extends Migration
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
        $this->insert('role', [
            'name' => 'admin'
        ]);
        $this->insert('role', [
            'name' => 'user'
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
        $this->createTable('nav', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL'
        ]);
        $this->createTable('subnav', [
            'id' => Schema::TYPE_PK,
            'nav_id' => Schema::TYPE_INTEGER . ' NOT NULL', 
            'name' => Schema::TYPE_STRING . ' NOT NULL'
        ]);
        $this->createIndex(
            'idx-subnav-nav_id',
            'subnav',
            'nav_id'
        );
        $this->addForeignKey(
            'fk-subnav-nav_id',
            'subnav',
            'nav_id',
            'nav',
            'id',
            'CASCADE'
        );
        $this->createTable('article', [
            'id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'subnav_id' => Schema::TYPE_INTEGER . ' NOT NULL', 
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'description' => Schema::TYPE_STRING . ' NOT NULL',
            'image' => Schema::TYPE_STRING . ' NOT NULL',
            'created_at' => Schema::TYPE_TIMESTAMP . ' NOT NULL'
        ]);
        $this->createIndex(
            'idx-article-user_id',
            'article',
            'user_id'
        );
        $this->addForeignKey(
            'fk-article-user_id',
            'article',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
        $this->createIndex(
            'idx-article-subnav_id',
            'article',
            'subnav_id'
        );
        $this->addForeignKey(
            'fk-article-subnav_id',
            'article',
            'subnav_id',
            'subnav',
            'id',
            'CASCADE'
        );
        $this->createTable('commentary', [
            'id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'article_id' => Schema::TYPE_INTEGER . ' NOT NULL', 
            'text' => Schema::TYPE_STRING . ' NOT NULL',
            'created_at' => Schema::TYPE_TIMESTAMP . ' NOT NULL'
        ]);
        $this->createIndex(
            'idx-commentary-user_id',
            'commentary',
            'user_id'
        );
        $this->addForeignKey(
            'fk-commentary-user_id',
            'commentary',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
        $this->createIndex(
            'idx-commentary-article_id',
            'commentary',
            'article_id'
        );
        $this->addForeignKey(
            'fk-commentary-article_id',
            'commentary',
            'article_id',
            'article',
            'id',
            'CASCADE'
        );
        $this->createTable('subcommentary', [
            'id' => Schema::TYPE_PK,
            'commentary_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'sender_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'addressee_id' => Schema::TYPE_INTEGER . ' NOT NULL', 
            'text' => Schema::TYPE_STRING . ' NOT NULL',
            'created_at' => Schema::TYPE_TIMESTAMP . ' NOT NULL'
        ]);
        $this->createIndex(
            'idx-subcommentary-commentary_id',
            'subcommentary',
            'commentary_id'
        );
        $this->addForeignKey(
            'fk-subcommentary-commentary_id',
            'subcommentary',
            'commentary_id',
            'commentary',
            'id',
            'CASCADE'
        );
        $this->createIndex(
            'idx-subcommentary-sender_id',
            'subcommentary',
            'sender_id'
        );
        $this->addForeignKey(
            'fk-subcommentary-sender_id',
            'subcommentary',
            'sender_id',
            'user',
            'id',
            'CASCADE'
        );
        $this->createIndex(
            'idx-subcommentary-addressee_id',
            'subcommentary',
            'addressee_id'
        );
        $this->addForeignKey(
            'fk-subcommentary-addressee_id',
            'subcommentary',
            'addressee_id',
            'user',
            'id',
            'CASCADE'
        );
        $this->createTable('type', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL'
        ]);
        $this->insert('type', [
            'name' => 'chapter'
        ]);
        $this->insert('type', [
            'name' => 'illustration'
        ]);
        $this->insert('type', [
            'name' => 'ordered list'
        ]);
        $this->insert('type', [
            'name' => 'unordered list'
        ]);
        $this->createTable('group', [
            'id' => Schema::TYPE_PK,
            'article_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'type_id' => Schema::TYPE_INTEGER . ' NOT NULL', 
            'sequence' => Schema::TYPE_TINYINT . ' NOT NULL',
            'value' => Schema::TYPE_STRING . ' NOT NULL',
        ]);
        $this->createIndex(
            'idx-group-article_id',
            'group',
            'article_id'
        );
        $this->addForeignKey(
            'fk-group-article_id',
            'group',
            'article_id',
            'article',
            'id',
            'CASCADE'
        );
        $this->createIndex(
            'idx-group-type_id',
            'group',
            'type_id'
        );
        $this->addForeignKey(
            'fk-group-type_id',
            'group',
            'type_id',
            'type',
            'id',
            'CASCADE'
        );
        $this->createTable('content', [
            'group_id' => Schema::TYPE_INTEGER . ' NOT NULL', 
            'sequence' => Schema::TYPE_TINYINT . ' NOT NULL',
            'value' => Schema::TYPE_STRING . ' NOT NULL',
        ]);
        $this->createIndex(
            'idx-content-group_id',
            'content',
            'group_id'
        );
        $this->addForeignKey(
            'fk-content-group_id',
            'content',
            'group_id',
            'group',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('content');
        $this->dropTable('group');
        $this->dropTable('type');
        $this->dropTable('subcommentary');
        $this->dropTable('commentary');
        $this->dropTable('article');
        $this->dropTable('user');
        $this->dropTable('role');
        $this->dropTable('subnav');
        $this->dropTable('nav');
    }
}
