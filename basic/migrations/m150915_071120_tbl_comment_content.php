<?php

use yii\db\Schema;
use yii\db\Migration;

class m150915_071120_tbl_comment_content extends Migration
{
    public function up()
    {
        $this->alterColumn('comment', 'content', 'text NOT NULL');
    }

    public function down()
    {
        $this->alterColumn('comment', 'content', 'string NOT NULL');
    }
}
