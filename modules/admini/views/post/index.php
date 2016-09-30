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
//            'filterSelector' => "select[name='" . $dataProvider->getPagination()->pageSizeParam . "'],input[name='" . $dataProvider->getPagination()->pageParam . "']",
//            'pager' => [
//                'options' => ['style' => 'display:inline;padding-right:5px;', 'class' => 'pagination'],
//                'class' => \liyunfang\pager\LinkPager::className(),
//                'template' => '{pageButtons} {customPage} {pageSize}',
//                'pageSizeList' => [2, 3, 4, 5],
//                'pageSizeMargin' => 'margin-left:5px;margin-right:5px;',
//                'pageSizeOptions' => ['class' => 'form-control', 'style' => 'display: inline-block;width:auto;margin-top:0px;'],
//                'customPageWidth' => 50,
//                'customPageBefore' => ' 跳转 ',
//                'customPageAfter' => ' 页数 ',
//                'customPageMargin' => 'margin-left:5px;margin-right:5px;',
//                'customPageOptions' => ['class' => 'form-control', 'style' => 'display: inline-block;margin-top:0px;']
//            ],
//            'layout' => '{items}<div class="row"><div class="pull-left">{summary}</div><div class="pull-right">{pager}</div></div>',
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
                    'attribute' => 'status',
                    'value' => function ($m) {
                        return Post::$statusList[$m->status];
                    }
                ],
                [
                    'attribute' => 'create_time',
                    'value' => function ($m) {
                        return date("Y/m/d H:i", $m->update_time);
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