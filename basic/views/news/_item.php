<?php
use yii\helpers\Html;

echo Html::a(
    Html::tag('div',
        Html::tag('h3',$model->title).Html::tag('p', substr($model->content, 0, 1000).'...' ),
        ['class' => 'news']),
    ['news/view', 'id' => $model->id],
    ['class' => 'link-news']
);
