<?php

/* @var $this yii\web\View */
/* @var $model app\models\Post */

$this->title = '技术文章';
$this->params['breadcrumbs'][] = ['label' => '技术文章', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['/post/view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '编辑';

echo $this->render('_form', ['model' => $model]);
?>
