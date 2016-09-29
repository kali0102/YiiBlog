<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tb_category".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 * @property integer $level
 */
class Category extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'tb_category';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['parent_id', 'level'], 'integer'],
            [['name'], 'string', 'max' => 64],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => '主键',
            'parent_id' => '上级',
            'name' => '名称',
            'level' => '层级'
        ];
    }

    public static function find()
    {
        return new CategoryQuery(get_called_class());
    }

    public static function getFirstLevelList()
    {
        $models = self::find()->select(['id', 'name'])->all();
        return ArrayHelper::map($models, 'id', 'name');
    }

    public static function getSecondLevelList()
    {
        $models = self::find()->select(['id', 'name'])->all();
        return ArrayHelper::map($models, 'id', 'name');
    }
}
