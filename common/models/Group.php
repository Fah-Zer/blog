<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%group}}".
 *
 * @property int $id
 * @property int $article_id
 * @property int $type_id
 * @property int $sequence
 * @property string $value
 *
 * @property Article $article
 * @property Content[] $contents
 * @property Type $type
 */
class Group extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%group}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['article_id', 'type_id', 'sequence', 'value'], 'required'],
            [['article_id', 'type_id', 'sequence'], 'integer'],
            [['value'], 'string', 'max' => 255],
            [['article_id'], 'exist', 'skipOnError' => true, 'targetClass' => Article::className(), 'targetAttribute' => ['article_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Type::className(), 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'article_id' => 'Article ID',
            'type_id' => 'Type ID',
            'sequence' => 'Sequence',
            'value' => 'Value',
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
     * Gets query for [[Contents]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\ContentQuery
     */
    public function getContents()
    {
        return $this->hasMany(Content::className(), ['group_id' => 'id']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\TypeQuery
     */
    public function getType()
    {
        return $this->hasOne(Type::className(), ['id' => 'type_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\GroupQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\GroupQuery(get_called_class());
    }
}
