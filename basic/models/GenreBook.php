<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "genre_book".
 *
 * @property integer $id
 * @property integer $book_id
 * @property integer $genre_id
 */
class GenreBook extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'genre_book';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['book_id', 'genre_id'], 'required'],
            [['book_id', 'genre_id'], 'integer']
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
            'genre_id' => 'Genre ID',
        ];
    }

    /**
     * @inheritdoc
     * @return GenreBookQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GenreBookQuery(get_called_class());
    }
}
