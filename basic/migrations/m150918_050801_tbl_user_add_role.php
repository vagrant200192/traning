<?php

use yii\db\Schema;
use yii\db\Migration;

class m150918_050801_tbl_user_add_role extends Migration
{
    public function up()
    {
        $this->addColumn('user', 'role', 'int NOT NULL DEFAULT 10');
        $this->batchInsert('user', ['email', 'password', 'role'] ,[
            ['admin@admin.com', Yii::$app->security->generatePasswordHash('admin123456'), 20],
        ]);
    }

    public function down()
    {
        $this->dropColumn('user', 'role');
    }

}
