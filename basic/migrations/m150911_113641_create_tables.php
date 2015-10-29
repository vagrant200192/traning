<?php

use yii\db\Schema;
use yii\db\Migration;

class m150911_113641_create_tables extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === "mysql"){
            $tableOptions = "CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB";
        }

        $this->createTable("user", [
            "id" => "pk",
            "email" => "string",
            "password" => "string",
        ], $tableOptions);

        $this->createTable("news", [
            "id" => "pk",
            "title" => "string NOT NULL",
            "content" => "text NOT NULL",
            "created_at" => "datetime NOT NULL",
        ], $tableOptions);

        $this->createTable("book", [
            "id" => "pk",
            "title" => "string NOT NULL",
            "about" => "text",
            "publish_date" => "string",
            "cover" => "string",
            "author" => "string",
        ], $tableOptions);

        $this->createTable("comment", [
            "id" => "pk",
            "author" => "string NOT NULL",
            "content" => "string NOT NULL",
            "created_at" => "datetime NOT NULL",
            "book_id" => "int NOT NULL",
        ], $tableOptions);

        $this->createTable("genre", [
            "id" => "pk",
            "name" => "string NOT NULL",
        ], $tableOptions);

        $this->createTable("genre_book", [
            "id" => "pk",
            "book_id" => "int NOT NULL",
            "genre_id" => "int NOT NULL",
        ], $tableOptions);

        $this->createTable("rating_book", [
            "id" => "pk",
            "book_id" => "int NOT NULL",
            "user_id" => "int NOT NULL",
            "rating" => "int NOt NULL",
        ]);
    }

    public function down()
    {
        $this->dropTable("user");
        $this->dropTable("news");
        $this->dropTable("book");
        $this->dropTable("comment");
        $this->dropTable("genre");
        $this->dropTable("genre_book");
        $this->dropTable("rating_book");
    }
}
