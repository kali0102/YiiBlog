<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '技术文章';
$this->params['breadcrumbs'][] = $this->title;

?>


<div class="col-lg-9">
    <div class="post-index">
        <?php
        echo ListView::widget([
            'summary' => false,
            'dataProvider' => $dataProvider,
            'itemView' => '_view',
        ]);
        ?>
    </div>
</div>

<div class="col-lg-3">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">文章分类</h3>
        </div>
        <div class="panel-body">
            <?php foreach ($categoryOptions as $name => $category): ?>
                <div class="btn-group">
                    <button type="button" class="btn btn-info"><?= $name ?></button>
                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <?php if (!empty($category)): ?>
                            <?php foreach ($category as $id => $value): ?>
                                <li><a href="<?= Url::to(['/post', 'cate' => $id]) ?>"><?= $value ?></a></li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
                <p></p>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">热门文章</h3>
        </div>
        <div class="panel-body">
            <?php foreach ($popularRecommendPosts as $post): ?>
                <p><?= Html::a($post->title, ['/post/view', 'id' => $post->id]) ?></p>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">热门标签</h3>
        </div>
        <div class="panel-body">
            <?php foreach ($popularTags as $tag): ?>
                <a href="<?= Url::to(['/post', 'tag' => $tag->name]) ?>">
                    <span class="text-danger"><?= $tag->name ?></span>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>

