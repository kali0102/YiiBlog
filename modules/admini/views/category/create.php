<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Category */

$this->title = '文章分类';
$this->params['breadcrumbs'][] = ['label' => '文章分类', 'url' => ['index']];
$this->params['breadcrumbs'][] = '添加';

echo $this->render('_form', ['model' => $model]);
?>
