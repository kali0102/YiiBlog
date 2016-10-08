<?php

/**
 * 文章模型
 *
 * @author kali.liu <kali.liu@qq.com>
 * @link http://www.fansye.com/
 * @copyright Copyright &copy; 2016-2068 Fansye.com Inc
 *
 * This is the model class for table "{{%post}}".
 *
 * @property integer $id
 * @property integer $category_id
 * @property integer $user_id
 * @property string $title
 * @property string $content
 * @property string $tags
 * @property integer $status
 * @property integer $recommend
 * @property string $summary
 * @property integer $create_time
 * @property integer $update_time
 */

namespace app\models;

use Yii;
use app\modules\admini\models\User;

class Post extends \yii\db\ActiveRecord
{

    private $_oldTags = '';

    const STATUS_DRAFT = 0;
    const STATUS_PUBLISHED = 1;
    const STATUS_ARCHIVED = 2;

    const RECOMMEND_YES = 1;
    const RECOMMEND_NO = 0;

    public static $statusList = [
        self::STATUS_DRAFT => '草稿',
        self::STATUS_PUBLISHED => '发布',
        self::STATUS_ARCHIVED => '归档'
    ];

    public static $recommendList = [
        self::RECOMMEND_YES => '是',
        self::RECOMMEND_NO => '否'
    ];

    public static function tableName()
    {
        return '{{%post}}';
    }

    public function rules()
    {
        return [
            [['category_id', 'summary', 'title', 'content', 'tags', 'status'], 'required'],
            [['category_id', 'user_id', 'status', 'recommend', 'create_time', 'update_time'], 'integer'],
            [['content', 'tags', 'summary'], 'string'],
            ['recommend', 'default', 'value' => 0],
            [['title'], 'string', 'max' => 128],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            ['tags', 'normalizeTags']
        ];
    }

    public function normalizeTags()
    {
        $tags = Tag::stringToArray($this->tags);
        $this->tags = implode(',', array_unique($tags));
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function attributeLabels()
    {
        return [
            'id' => '主键',
            'category_id' => '分类',
            'user_id' => '作者',
            'title' => '标题',
            'content' => '内容',
            'tags' => '标签',
            'status' => '状态',//（0草稿、1公布、2归档）
            'recommend' => '推荐',// (0否、1是)
            'summary' => '简介',
            'create_time' => '创建时间',
            'update_time' => '更新时间',
        ];
    }

    public function afterDelete()
    {
        parent::afterDelete();
        $model = new Tag;
        $model->updateFrequency($this->tags, '');
        self::latest('', true);
        self::popularRecommend('', true);
    }

    public function afterFind()
    {
        parent::afterFind();
        $this->_oldTags = $this->tags;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        $model = new Tag;
        $model->updateFrequency($this->_oldTags, $this->tags);
        self::latest('', true);
        self::popularRecommend('', true);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->create_time = $this->update_time = time();
                $this->user_id = 1;
            } else
                $this->update_time = time();
            return true;
        }
        return false;
    }

    public static function find()
    {
        return new PostQuery(get_called_class());
    }

    /**
     * 热门推荐
     * @param int $num
     * @param bool $refreshCache
     * @return Post[]|array|mixed|\yii\db\ActiveRecord[]
     */
    public static function popularRecommend($num = 6, $refreshCache = false)
    {
        if (!$refreshCache && $posts = Yii::$app->cache->get('popularRecommendPost')) {
            if (count($posts) == $num)
                return $posts;
        }

        $posts = self::find()
            ->where(['status' => self::STATUS_PUBLISHED, 'recommend' => self::RECOMMEND_YES])
            ->orderBy('update_time')
            ->limit($num)
            ->all();

        Yii::$app->cache->set('popularRecommendPost', $posts, 86400);
        return $posts;
    }


    /**
     * 最新文章
     * @param int $num
     * @param bool $refreshCache
     * @return Post[]|array|mixed|\yii\db\ActiveRecord[]
     */
    public static function latest($num = 6, $refreshCache = false)
    {
        if (!$refreshCache && $posts = Yii::$app->cache->get('latestPost')) {
            if (count($posts) == $num)
                return $posts;
        }

        $posts = self::find()
            ->where(['status' => self::STATUS_PUBLISHED])
            ->orderBy('update_time')
            ->limit($num)
            ->all();

        Yii::$app->cache->set('latestPost', $posts, 86400);
        return $posts;
    }
}
