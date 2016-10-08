<?php

/* @var $this yii\web\View */
/* @var $model app\modules\admini\models\User */

$this->title = '用户';
$this->params['breadcrumbs'][] = ['label' => '用户', 'url' => ['index']];
$this->params['breadcrumbs'][] = '添加';

echo $this->render('_form', ['model' => $model]);
?>
