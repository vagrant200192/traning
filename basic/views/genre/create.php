<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Genre */

$this->title = Yii::t('app', 'TITLE_CREATE_GENRE');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'TITLE_GENRES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="genre-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
