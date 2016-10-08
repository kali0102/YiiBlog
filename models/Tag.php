<?php

/**
 * 标签模型
 *
 * @author kali.liu <kali.liu@qq.com>
 * @link http://www.fansye.com/
 * @copyright Copyright &copy; 2016-2068 Fansye.com Inc
 *
 * This is the model class for table "tb_tag".
 *
 * @property integer $id
 * @property string $name
 * @property integer $frequency
 */

namespace app\models;

use Yii;

class Tag extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%tag}}';
    }


    public function rules()
    {
        return [
            [['name', 'frequency'], 'required'],
            [['frequency'], 'integer'],
            [['name'], 'string', 'max' => 64],
        ];
    }

    public static function find()
    {
        return new TagQuery(get_called_class());
    }

    /**
     * 字符串转数组
     * @param $tags
     * @return array
     */
    public static function stringToArray($tags)
    {
        return preg_split('/\s*,\s*/', trim($tags), -1, PREG_SPLIT_NO_EMPTY);
    }

    /**
     * 更新标签使用频率
     * @param $oldTags
     * @param $newTags
     */
    public function updateFrequency($oldTags, $newTags)
    {
        $oldTags = self::stringToArray($oldTags);
        $newTags = self::stringToArray($newTags);
        $this->addTags(array_diff($newTags, $oldTags));
        $this->removeTags(array_diff($oldTags, $newTags));
    }

    /**
     * 添加标签
     * @param $tags
     */
    public function addTags($tags)
    {
        self::updateAllCounters(['frequency' => 1], ['in', 'name', $tags]);
        foreach ($tags as $name) {
            if (!self::find()->where(['name' => $name])->exists()) {
                $tag = clone $this;
                $tag->name = $name;
                $tag->frequency = 1;
                $tag->save();
            }
        }
    }

    /**
     * 删除标签
     * @param $tags
     */
    public function removeTags($tags)
    {
        if (empty($tags))
            return;
        self::updateAllCounters(['frequency' => -1], ['in', 'name', $tags]);
        self::deleteAll('frequency <= 0');
    }


    /**
     * 热门标签
     * @param int $num
     * @param bool $refreshCache
     * @return Tag[]|array|mixed|\yii\db\ActiveRecord[]
     */
    public static function popular($num = 20, $refreshCache = false)
    {
        if (!$refreshCache && $tags = Yii::$app->cache->get('popularTags')) {
            if (count($tags) == $num)
                return $tags;
        }

        $tags = self::find()->orderBy('frequency')->limit($num)->all();

        Yii::$app->cache->set('popularTags', $tags, 86400);
        return $tags;
    }
}
