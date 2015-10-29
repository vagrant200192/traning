<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use app\models\Genre;
use app\models\Comment;

/**
 * This is the model class for table "book".
 *
 * @property integer $id
 * @property string $title
 * @property string $about
 * @property string $publish_date
 * @property string $cover
 * @property string $author
 */
class Book extends \yii\db\ActiveRecord
{
    protected $genres = [];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'book';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['about'], 'string'],
            [['genres'], 'safe'],
            [['title', 'publish_date', 'cover', 'author'], 'string', 'max' => 255]
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
            'about' => Yii::t('app', 'ATTR_ABOUT'),
            'publish_date' => Yii::t('app', 'ATTR_PUBLISH_DATE'),
            'cover' => Yii::t('app', 'ATTR_COVER'),
            'author' => Yii::t('app', 'ATTR_AUTHOR'),
            'genres' => Yii::t('app', 'ATTR_GENRE'),
        ];
    }

    /**
     * @inheritdoc
     * @return BookQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BookQuery(get_called_class());
    }

    public function getGenresBook()
    {
        return $this->hasMany(GenreBook::className(), ['book_id' => 'id']);
    }

    public function getGenresName()
    {
        return $this->hasMany(Genre::className(), ['id' => 'genre_id'])
            ->viaTable('genre_book', ['book_id' => 'id']);
    }

    public function getStringGenresName()
    {
        $genresName = $this->getGenresName()->all();
        $str = '';
        foreach ($genresName as $genre){
            $str.=' ' .$genre['name'];
        }
        return $str;
    }

    public function setGenres($genresId)
    {
        $this->genres = (array) $genresId;
    }

    public function getGenres()
    {
        return ArrayHelper::getColumn($this->getGenresBook()->all(), 'genre_id');
    }

    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['book_id' => 'id'])
            ->orderBy('created_at DESC');
    }

    public function addComment($comment)
    {
        $comment->author = Yii::$app->user->identity->email;
        $comment->created_at = (new \DateTime())->setTimezone(new \DateTimeZone('Asia/Novosibirsk'))->format('Y-m-d H:i:s');
        $comment->book_id = $this->id;
        $comment->save();
    }

    public function afterSave($insert, $changedAttributes)
    {
        GenreBook::deleteAll(['book_id' => $this->id]);
        $values = [];
        foreach ($this->genres as $id){
            $values[] = [$this->id, $id];
        }
        self::getDb()->createCommand()
            ->batchInsert(GenreBook::tableName(), ['book_id', 'genre_id'], $values)->execute();
        parent::afterSave($insert, $changedAttributes);
    }
}
