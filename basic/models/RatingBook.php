<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rating_book".
 *
 * @property integer $id
 * @property integer $book_id
 * @property integer $user_id
 * @property integer $rating
 */
class RatingBook extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rating_book';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['book_id', 'user_id', 'rating'], 'required'],
            [['book_id', 'user_id', 'rating'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'book_id' => 'Book ID',
            'user_id' => 'User ID',
            'rating' => 'Rating',
        ];
    }

    /**
     * @inheritdoc
     * @return RatingBookQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RatingBookQuery(get_called_class());
    }
}
