<?php

/**
 * 管理模块
 * 文章
 *
 * @author kali.liu <kali.liu@qq.com>
 * @link http://www.fansye.com/
 * @copyright Copyright &copy; 2016-2068 Fansye.com Inc
 */

namespace app\modules\admini\controllers;

use Yii;
use app\models\Post;
use app\models\PostSearch;
use yii\filters\VerbFilter;
use app\components\Controller;

class PostController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new PostSearch;
        $request = Yii::$app->request;
        $dataProvider = $searchModel->search($request->queryParams);
        return $this->render('index', compact('searchModel', 'dataProvider'));
    }

    public function actionCreate()
    {
        $model = new Post;
        $request = Yii::$app->request;
        if ($model->load($request->post()) && $model->save())
            return $this->redirect(['index']);
        return $this->render('create', compact('model'));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        $request = Yii::$app->request;
        if ($model->load($request->post()) && $model->save())
            return $this->redirect(['index']);
        return $this->render('update', compact('model'));
    }


    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();
        return $this->redirect(['index']);
    }

}
