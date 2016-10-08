<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admini\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '用户';
$this->params['breadcrumbs'][] = ['label' => '用户', 'url' => ['index']];
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

                'username',
                'email:email',
                'create_time:datetime',

            ],
        ]); ?>
        <?php Pjax::end(); ?>
    </div>
</div>