<?php

namespace app\controllers;


use app\models\Post;
use yii\web\Controller;

class TestController extends Controller
{

    public function actionIndex()
    {
        $cookies = Yii::$app->response->cookies;

        $cookies->add(new \yii\web\Cookie([
            'name' => 'fruit',
            'value' => 'orange',
            'expire' => time() + 3600
        ]));


        $cookies = Yii::$app->request->cookies;
        $fruit = $cookies->get('fruit', 'defaultValue');


        $cookies = Yii::$app->request->cookies;

        $cookies->remove('fruit');
    }
}