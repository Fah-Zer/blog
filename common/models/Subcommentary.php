<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%subcommentary}}".
 *
 * @property int $id
 * @property int $commentary_id
 * @property int $sender_id
 * @property int $addressee_id
 * @property string $text
 * @property string $created_at
 *
 * @property User $addressee
 * @property Commentary $commentary
 * @property User $sender
 */
class Subcommentary extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%subcommentary}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['commentary_id', 'sender_id', 'addressee_id', 'text'], 'required'],
            [['commentary_id', 'sender_id', 'addressee_id'], 'integer'],
            [['created_at'], 'safe'],
            [['text'], 'string', 'max' => 255],
            [['addressee_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['addressee_id' => 'id']],
            [['commentary_id'], 'exist', 'skipOnError' => true, 'targetClass' => Commentary::className(), 'targetAttribute' => ['commentary_id' => 'id']],
            [['sender_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['sender_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'commentary_id' => 'Commentary ID',
            'sender_id' => 'Sender ID',
            'addressee_id' => 'Addressee ID',
            'text' => 'Text',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Addressee]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getAddressee()
    {
        return $this->hasOne(User::className(), ['id' => 'addressee_id']);
    }

    /**
     * Gets query for [[Commentary]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\CommentaryQuery
     */
    public function getCommentary()
    {
        return $this->hasOne(Commentary::className(), ['id' => 'commentary_id']);
    }

    /**
     * Gets query for [[Sender]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getSender()
    {
        return $this->hasOne(User::className(), ['id' => 'sender_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\SubcommentaryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\SubcommentaryQuery(get_called_class());
    }
}
