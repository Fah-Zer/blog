<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%subnav}}".
 *
 * @property int $id
 * @property int $nav_id
 * @property string $name
 *
 * @property Article[] $articles
 * @property Nav $nav
 */
class Subnav extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%subnav}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nav_id', 'name'], 'required'],
            [['nav_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['nav_id'], 'exist', 'skipOnError' => true, 'targetClass' => Nav::className(), 'targetAttribute' => ['nav_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nav_id' => 'Nav ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[Articles]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\ArticleQuery
     */
    public function getArticles()
    {
        return $this->hasMany(Article::className(), ['subnav_id' => 'id']);
    }

    /**
     * Gets query for [[Nav]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\NavQuery
     */
    public function getNav()
    {
        return $this->hasOne(Nav::className(), ['id' => 'nav_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\SubnavQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\SubnavQuery(get_called_class());
    }
}
