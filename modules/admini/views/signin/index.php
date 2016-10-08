<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '登录';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>请填写以下信息以登录:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => '登录的用户名']) ?>

    <?= $form->field($model, 'password')->passwordInput(['placeholder' => '登录密码']) ?>

    <?php if ($model->scenario == 'captchaRequired'): ?>
        <?= $form->field($model, 'captcha')->widget(Captcha::className(), ['captchaAction' => 'signin/captcha',
            'template' => '<div class="row"><div class="col-lg-5">{input}</div><div class="col-lg-6">{image}</div></div>',
            'imageOptions' => ['alt' => '点击换图', 'title' => '点击换图', 'style' => 'cursor: pointer;']]); ?>
    <?php endif; ?>

    <?= $form->field($model, 'rememberMe')->checkbox(['template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",]) ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
