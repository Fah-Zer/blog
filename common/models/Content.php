<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%content}}".
 *
 * @property int $group_id
 * @property int $sequence
 * @property string $value
 *
 * @property Group $group
 */
class Content extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%content}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['group_id', 'sequence', 'value'], 'required'],
            [['group_id', 'sequence'], 'integer'],
            [['value'], 'string', 'max' => 255],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::className(), 'targetAttribute' => ['group_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'group_id' => 'Group ID',
            'sequence' => 'Sequence',
            'value' => 'Value',
        ];
    }

    /**
     * Gets query for [[Group]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\GroupQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'group_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\ContentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ContentQuery(get_called_class());
    }
}
