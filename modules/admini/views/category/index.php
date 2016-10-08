<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '文章分类';
$this->params['breadcrumbs'][] = ['label' => '文章分类', 'url' => ['index']];
$this->params['breadcrumbs'][] = '列表';
?>
<div class="panel panel-primary">
    <div class="panel-body">
        <?php Pjax::begin(); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'summary' => false,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                [
                    'attribute' => 'parent_id',
                    'value' => function ($m) {
                        return isset($m->parent) ? $m->parent->name : '';
                    }
                ],
                'name',

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update}'
                ],
            ],
        ]); ?>
        <?php Pjax::end(); ?>
    </div>
</div>
