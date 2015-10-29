<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Genre */

$this->title = Yii::t('app', 'TITLE_UPDATE_GENRE') . ': ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'TITLE_GENRES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'TITLE_UPDATE');
?>
<div class="genre-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
