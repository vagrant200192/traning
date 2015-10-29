<?php
namespace app\widgets;

use app\models\Language;
use yii\base\Widget;

class WLang extends \yii\bootstrap\Widget
{
    public function init(){}

    public function run(){
        return $this->render('lang/view', [
            'current' => Language::getCurrent(),
            'langs' => Language::find()->where('id != :current_id', [':current_id' => Language::getCurrent()->id])->all(),
        ]);
    }
}