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
        return '{{%category}}';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['parent_id', 'level'], 'integer'],
            ['parent_id', 'default', 'value' => 0],
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

    public function getParent()
    {
        return $this->hasOne(Category::className(), ['id' => 'parent_id']);
    }

    public static function find()
    {
        return new CategoryQuery(get_called_class());
    }


    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert)
                $this->level = !$this->parent_id ? 1 : 2;
            return true;
        }
        return false;
    }

    public function afterDelete()
    {
        parent::afterDelete();
        self::getList(true);
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        self::getList(true);
    }

    /**
     * 获得一级分类
     * @return array
     */
    public static function getFirstLevelList()
    {
        $models = self::find()->select(['id', 'name'])->where('level=1')->all();
        return ArrayHelper::map($models, 'id', 'name');
    }

    /**
     * 分类Option值列表
     * @param bool $refreshCache
     * @return array|mixed
     */
    public static function getList($refreshCache = false)
    {
        if (!$refreshCache && $options = Yii::$app->cache->get('categoryOptions'))
            return $options;
        $options = [];
        $categorys = self::find()->with('parent')->where("level=2")->all();
        foreach ($categorys as $category) {
            if (!isset($options[$category->parent->name]))
                $options[$category->parent->name] = [];
            $options[$category->parent->name][$category->id] = $category->name;
        }
        Yii::$app->cache->set('categoryOptions', $options, 86400);
        return $options;
    }
}
