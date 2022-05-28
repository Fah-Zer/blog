<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property int $id
 * @property int $role_id
 * @property string $nickname
 * @property string $email
 * @property string $password
 * @property string $image
 *
 * @property Article[] $articles
 * @property Commentary[] $commentaries
 * @property Role $role
 * @property Subcommentary[] $subcommentaries
 * @property Subcommentary[] $subcommentaries0
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['role_id'], 'integer'],
            [['nickname', 'email', 'password', 'image'], 'required'],
            [['nickname', 'email', 'password', 'image'], 'string', 'max' => 255],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => Role::className(), 'targetAttribute' => ['role_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role_id' => 'Role ID',
            'nickname' => 'Nickname',
            'email' => 'Email',
            'password' => 'Password',
            'image' => 'Image',
        ];
    }

    /**
     * Gets query for [[Articles]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\ArticleQuery
     */
    public function getArticles()
    {
        return $this->hasMany(Article::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Commentaries]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\CommentaryQuery
     */
    public function getCommentaries()
    {
        return $this->hasMany(Commentary::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Role]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\RoleQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::className(), ['id' => 'role_id']);
    }

    /**
     * Gets query for [[Subcommentaries]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\SubcommentaryQuery
     */
    public function getSubcommentaries()
    {
        return $this->hasMany(Subcommentary::className(), ['addressee_id' => 'id']);
    }

    /**
     * Gets query for [[Subcommentaries0]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\SubcommentaryQuery
     */
    public function getSubcommentaries0()
    {
        return $this->hasMany(Subcommentary::className(), ['sender_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\UserQuery(get_called_class());
    }
}
