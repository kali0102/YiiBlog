<?php

namespace app\controllers;

use Yii;
use app\models\Tag;
use app\models\Post;
use app\models\PostSearch;
use app\components\Controller;
use app\models\Category;
use yii\data\ActiveDataProvider;

class PostController extends Controller
{

    public function actionIndex()
    {
//        $searchModel = new PostSearch();
//        $request = Yii::$app->request;
//        $dataProvider = $searchModel->search($request->queryParams);


        $query = Post::find();
        $query->where(['status' => Post::STATUS_PUBLISHED]);
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
//            'searchModel' => $searchModel,
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

}
