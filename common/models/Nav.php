<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%nav}}".
 *
 * @property int $id
 * @property string $name
 *
 * @property Subnav[] $subnavs
 */
class Nav extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%nav}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[Subnavs]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\SubnavQuery
     */
    public function getSubnavs()
    {
        return $this->hasMany(Subnav::className(), ['nav_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\NavQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\NavQuery(get_called_class());
    }
}
