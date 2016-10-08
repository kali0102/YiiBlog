<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index" xmlns="http://www.w3.org/1999/html">
    <div class="jumbotron">
        <h1>Congratulations!</h1>
        <p class="lead">欢迎来到 <a href="http://www.fansye.com" target="_blank">六智科技</a> 技术博客</p>
        <p><a class="btn btn-lg btn-success" href="<?= Url::to(['/post']) ?>">查看所有文章</a></p>
    </div>
    <div class="body-content">
        <div class="row">
            <div class="col-lg-4">
                <h3>最新文章</h3>
                <?php foreach ($latestPosts as $post): ?>
                    <p><?= Html::a($post->title, ['/post/view', 'id' => $post->id]) ?></p>
                <?php endforeach; ?>
                <p><a class="btn btn-default" href="<?= Url::to(['/post']) ?>">更多文章 &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h3>热门推荐</h3>
                <?php foreach ($popularRecommendPosts as $post): ?>
                    <p><?= Html::a($post->title, ['/post/view', 'id' => $post->id]) ?></p>
                <?php endforeach; ?>
                <p><a class="btn btn-default" href="<?= Url::to(['/post']) ?>">更多热门 &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h3>常用标签</h3>
                <div>
                    <?php foreach ($popularTags as $tag): ?>
                        <a href="<?= Url::to(['/post', 'tag' => $tag->name]) ?>">
                            <span class="text-danger"><?= $tag->name ?></span>
                        </a>
                    <?php endforeach; ?>
                </div>
                <p></p>
                <p><a class="btn btn-default" href="<?= Url::to(['/post']) ?>">全部标签 &raquo;</a></p>
            </div>
        </div>
    </div>
</div>