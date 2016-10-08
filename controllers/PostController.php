<?php

/**
 * 文章
 *
 * @author kali.liu <kali.liu@qq.com>
 * @link http://www.fansye.com/
 * @copyright Copyright &copy; 2016-2068 Fansye.com Inc
 */

namespace app\controllers;

use Yii;
use app\models\Tag;
use app\models\Post;
use app\models\Category;
use yii\web\Controller;
use yii\data\ActiveDataProvider;

class PostController extends Controller
{

    public function actionIndex()
    {
        $query = Post::find();
        $query->where(['status' => Post::STATUS_PUBLISHED]);

        $request = Yii::$app->request;
        if ($cate = intval($request->get('cate', 0)))
            $query->andWhere(['category_id' => $cate]);
        if ($tag = trim($request->get('tag', '')))
            $query->andWhere(['like', 'tags', $tag]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 2],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC
                ]
            ],
        ]);

        $popularRecommendPosts = Post::popularRecommend();
        $popularTags = Tag::popular();
        $categoryOptions = Category::getList();

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'popularTags' => $popularTags,
            'popularRecommendPosts' => $popularRecommendPosts,
            'categoryOptions' => $categoryOptions
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->loadModel($id),
        ]);
    }

    public function loadModel($id)
    {
        $query = Post::find();
        $query->where(['status' => Post::STATUS_PUBLISHED]);
        $query->andWhere(['id' => $id]);
        $model = $query->one();
        if ($model === null)
            throw new NotFoundHttpException('', '404');
        return $model;
    }

}
