<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => '文章', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="content">
        <?= Html::decode($model->content); ?>
    </div>
</div>
