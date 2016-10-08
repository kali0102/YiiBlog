<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Post;
use app\models\Tag;

class SiteController extends Controller
{

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $popularRecommendPosts = Post::popularRecommend();
        $latestPosts = Post::latest();
        $popularTags = Tag::popular();
        return $this->render('index', [
            'latestPosts' => $latestPosts,
            'popularRecommendPosts' => $popularRecommendPosts,
            'popularTags' => $popularTags
        ]);
    }

}
