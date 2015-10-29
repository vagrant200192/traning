<?php

use yii\helpers\Html;

echo
    Html::tag('div',
        Html::tag('div', Html::img($model->cover, ['class' => 'book-img'])) .
        Html::tag('div',
            Html::tag('p', $model->getAttributeLabel('title').': '. Html::a($model->title, ['book/view', 'id' => $model->id]) ) .
            Html::tag('p', $model->getAttributeLabel('author').': '. $model->author),
            ['class' => 'book-content']
        ),
        ['class' => 'book']
    );

