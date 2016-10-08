<?php

namespace app\controllers;

use Yii;
use app\models\Tag;
use app\models\Post;
use app\models\PostSearch;
use app\components\Controller;
use app\models\Category;

class PostController extends Controller
{

    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $request = Yii::$app->request;
        $dataProvider = $searchModel->search($request->queryParams);
        $popularRecommendPosts = Post::popularRecommend();
        $popularTags = Tag::popular();
        $categoryOptions = Category::getList();

        return $this->render('index', [
            'searchModel' => $searchModel,
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
