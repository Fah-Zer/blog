<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%commentary}}".
 *
 * @property int $id
 * @property int $user_id
 * @property int $article_id
 * @property string $text
 * @property string $created_at
 *
 * @property Article $article
 * @property Subcommentary[] $subcommentaries
 * @property User $user
 */
class Commentary extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%commentary}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'article_id', 'text'], 'required'],
            [['user_id', 'article_id'], 'integer'],
            [['created_at'], 'safe'],
            [['text'], 'string', 'max' => 255],
            [['article_id'], 'exist', 'skipOnError' => true, 'targetClass' => Article::className(), 'targetAttribute' => ['article_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'article_id' => 'Article ID',
            'text' => 'Text',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Article]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\ArticleQuery
     */
    public function getArticle()
    {
        return $this->hasOne(Article::className(), ['id' => 'article_id']);
    }

    /**
     * Gets query for [[Subcommentaries]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\SubcommentaryQuery
     */
    public function getSubcommentaries()
    {
        return $this->hasMany(Subcommentary::className(), ['commentary_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\CommentaryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\CommentaryQuery(get_called_class());
    }
}
