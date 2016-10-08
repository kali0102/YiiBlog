<?php

/* @var $this yii\web\View */
/* @var $model app\models\Category */

$this->title = '文章分类';
$this->params['breadcrumbs'][] = ['label' => '文章分类', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['update', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '编辑';

echo $this->render('_form', ['model' => $model]);
?>