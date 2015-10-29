<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property integer $id
 * @property string $author
 * @property string $content
 * @property string $created_at
 * @property integer $book_id
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['author', 'content'], 'required'],
            [['created_at'], 'safe'],
            [['book_id'], 'integer'],
            [['content'], 'string', 'max' => 10000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author' => Yii::t('app', 'ATTR_AUTHOR'),
            'content' => Yii::t('app', 'ATTR_CONTENT'),
            'created_at' => Yii::t('app', 'ATTR_CREATED_AT'),
            'book_id' => 'Book ID',
        ];
    }

    /**
     * @inheritdoc
     * @return CommentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CommentQuery(get_called_class());
    }

    public function getBook()
    {
        return $this->hasOne(Book::className(), ['id' => 'book_id'] );
    }
}
