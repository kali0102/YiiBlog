<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => '文章', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile('/static/styles/shCore.css');
$this->registerCssFile('/static/styles/shThemeDefault.css');
$this->registerCss('.syntaxhighlighter { overflow: hidden !important; }');

$this->registerJsFile('/static/scripts/shCore.js', ['depends' => ['app\assets\AppAsset']]);
$this->registerJsFile('/static/scripts/shBrushPhp.js', ['depends' => ['app\assets\AppAsset']]);

$this->registerJs('
SyntaxHighlighter.all()
', \yii\web\View::POS_END);
?>
<div class="post-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="content">
        <?= Html::decode($model->content); ?>
    </div>
</div>
