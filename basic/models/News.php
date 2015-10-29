<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $created_at
 */
class News extends \yii\db\ActiveRecord
{
    public function beforeSave($insert)
    {
        $date = (new \DateTime())->setTimezone(new \DateTimeZone('Asia/Novosibirsk'))->format('Y-m-d H:i:s');
        $this->created_at = $date;
        return parent::beforeSave($insert);
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content',], 'required'],
            [['content'], 'string'],
            [['created_at'], 'safe'],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => Yii::t('app', 'ATTR_TITLE'),
            'content' => Yii::t('app', 'ATTR_CONTENT'),
            'created_at' => Yii::t('app', 'ATTR_CREATED_AT'),
        ];
    }

    /**
     * @inheritdoc
     * @return NewsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NewsQuery(get_called_class());
    }
}
