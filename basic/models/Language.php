<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "language".
 *
 * @property integer $id
 * @property string $url
 * @property string $local
 * @property string $name
 * @property integer $default
 */
class Language extends \yii\db\ActiveRecord
{
    static $current = null;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'language';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url', 'local', 'name'], 'required'],
            [['default'], 'integer'],
            [['url', 'local', 'name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'Url',
            'local' => 'Local',
            'name' => 'Name',
            'default' => 'Default',
        ];
    }

    static function getCurrent()
    {
        if (self::$current === null){
            self::$current = self::getDefaultLang();
        }
        return self::$current;
    }

    static function setCurrent($url = null)
    {
        $language = self::getLangByUrl($url);
        self::$current = ($language === null) ? self::getDefaultLang() : $language;
        Yii::$app->language = self::$current->local;
    }

    static function getDefaultLang()
    {
        return Language::find()->where('`default` = :default', [':default' => 1])->one();
    }

    static function getLangByUrl($url = null)
    {
        if ($url === null){
            return null;
        }
        else{
            $language = Language::find()->where('url = :url', [':url' => $url])->one();
            if ($language === null){
                return null;
            }
            else{
                return $language;
            }
        }
    }
}
