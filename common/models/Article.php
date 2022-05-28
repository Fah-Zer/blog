<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%article}}".
 *
 * @property int $id
 * @property int $user_id
 * @property int $subnav_id
 * @property string $name
 * @property string $description
 * @property string $image
 * @property string $created_at
 *
 * @property Commentary[] $commentaries
 * @property Group[] $groups
 * @property Subnav $subnav
 * @property User $user
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%article}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'subnav_id', 'name', 'description', 'image'], 'required'],
            [['user_id', 'subnav_id'], 'integer'],
            [['created_at'], 'safe'],
            [['name', 'description', 'image'], 'string', 'max' => 255],
            [['subnav_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subnav::className(), 'targetAttribute' => ['subnav_id' => 'id']],
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
            'subnav_id' => 'Subnav ID',
            'name' => 'Name',
            'description' => 'Description',
            'image' => 'Image',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Commentaries]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\CommentaryQuery
     */
    public function getCommentaries()
    {
        return $this->hasMany(Commentary::className(), ['article_id' => 'id']);
    }

    /**
     * Gets query for [[Groups]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\GroupQuery
     */
    public function getGroups()
    {
        return $this->hasMany(Group::className(), ['article_id' => 'id']);
    }

    /**
     * Gets query for [[Subnav]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\SubnavQuery
     */
    public function getSubnav()
    {
        return $this->hasOne(Subnav::className(), ['id' => 'subnav_id']);
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
     * @return \common\models\query\ArticleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ArticleQuery(get_called_class());
    }
}
