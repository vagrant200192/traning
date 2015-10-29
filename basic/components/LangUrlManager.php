<?php

namespace app\components;

use yii\web\UrlManager;
use app\models\Language;

class LangUrlManager extends UrlManager
{
    public function createUrl($params)
    {
        if (isset($params['lang_id'])){
            $lang = Language::findOne($params['lang_id']);
            if ($lang === null){
                $lang = Language::getDefaultLang();
            }
            unset($params['lang_id']);
        }
        else{
            $lang = Language::getCurrent();
        }

        $url = parent::createUrl($params);

        if ($url == '/'){
            return '/'.$lang->url;
        }
        else{
            return '/'.$lang->url.$url;
        }
    }
}