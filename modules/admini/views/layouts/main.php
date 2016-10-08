<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body style="font-family: 'Microsoft YaHei UI'">
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Yii Blog',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            [
                'label' => '技术文章',
                'url' => '#',
                'items' => [
                    ['label' => '文章列表', 'url' => ['/admini/post']],
                    ['label' => '添加文章', 'url' => ['/admini/post/create']],
                ]
            ],
            [
                'label' => '文章分类',
                'url' => '#',
                'items' => [
                    ['label' => '分类列表', 'url' => ['/admini/category']],
                    ['label' => '添加分类', 'url' => ['/admini/category/create']],
                ]
            ],
            [
                'label' => '用户',
                'url' => '#',
                'items' => [
                    ['label' => '用户列表', 'url' => ['/admini/user']],
                    ['label' => '添加用户', 'url' => ['/admini/user/create']],
                ]
            ],
            Yii::$app->user->isGuest ? (
            ''
            ) : (
                '<li>'
                . Html::beginForm(['/admini/logout'], 'post', ['class' => 'navbar-form'])
                . Html::submitButton(
                    '退出 (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Fansye.com <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
