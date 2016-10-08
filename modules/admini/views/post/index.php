<?php

use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Post;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '技术文章';
$this->params['breadcrumbs'][] = ['label' => '技术文章', 'url' => ['index']];
$this->params['breadcrumbs'][] = '列表';
?>

<div class="panel panel-primary">
    <div class="panel-body">
        <div class="pull-right">
            <?= $this->render('_search', ['model' => $searchModel]); ?>
        </div>
    </div>
</div>

<div class="panel panel-primary">
    <div class="panel-body">
        <?php Pjax::begin(); ?>
        <?= GridView::widget([
            'summary' => false,
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'title',
                [
                    'attribute' => 'category_id',
                    'value' => function ($m) {
                        return $m->category->name;
                    }
                ],
                [
                    'attribute' => 'user_id',
                    'value' => function ($m) {
                        return $m->user->username;
                    }
                ],

                [
                    'attribute' => 'recommend',
                    'value' => function ($m) {
                        return Post::$recommendList[$m->recommend];
                    }
                ],

                [
                    'attribute' => 'create_time',
                    'value' => function ($m) {
                        return date("Y/m/d H:i", $m->update_time);
                    }
                ],

                [
                    'attribute' => 'status',
                    'value' => function ($m) {
                        return Post::$statusList[$m->status];
                    }
                ],

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update}'
                ],
            ],
        ]); ?>
        <?php Pjax::end(); ?>
    </div>
</div>