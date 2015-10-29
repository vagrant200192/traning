<?php

use yii\helpers\Html;
use app\models\User;

foreach ($comments as $comment){
    if (User::isUserAdmin(Yii::$app->user->identity->email))
       echo Html::a(Yii::t('app', 'BUTTON_DELETE'), ['comment/delete', 'id' => $comment['id']], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]);

   echo Html::tag('div',
        Html::tag('p', Yii::t('app', 'ATTR_AUTHOR') . ': ' . $comment['author']) .
        Html::tag('p', Yii::t('app', 'ATTR_CREATED_AT') . ': ' . $comment['created_at']) .
        Html::tag('p', Yii::t('app', 'ATTR_CONTENT') . ': ' . $comment['content']),
       ['class' => 'comment']
        );
}