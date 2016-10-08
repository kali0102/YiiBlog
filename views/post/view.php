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
<link href="/static/styles/shCore.css" rel="stylesheet" type="text/css"/>
<link href="/static/styles/shThemeDefault.css" rel="stylesheet" type="text/css"/>
<script src="/static/scripts/shCore.js" type="text/javascript"></script>
<script src="/static/scripts/shBrushPhp.js" type="text/javascript"></script>
<script type="text/javascript">
    SyntaxHighlighter.all()
</script>