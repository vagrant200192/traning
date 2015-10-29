<?php

use yii\db\Schema;
use yii\db\Migration;

class m150915_120445_tbl_language extends Migration
{
    public function safeUp()
    {
        $this->createTable('language', [
            'id' => 'pk',
            'url' => 'string NOT NULL',
            'local' => 'string NOT NULL',
            'name' => 'string NOT NULL',
            'default' => 'int(1) NOT NULL DEFAULT 0',
        ], 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB' );

        $this->batchInsert('language', ['url', 'local', 'name', 'default'] ,[
            ['en', 'en-EN', 'English', 0],
            ['ru', 'ru-RU', 'Русский', 1],
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('language');
    }
}
