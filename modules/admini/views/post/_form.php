<?php

use app\models\Category;
use app\models\Post;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Post */
/* @var $form yii\widgets\ActiveForm */


$defaultFieldConfig = [
    'template' => "{label}\n<div class=\"col-lg-6\">{input}</div>\n<div class=\"col-lg-4\">{error}</div>",
    'labelOptions' => ['class' => 'col-lg-2 control-label'],
];

$optionFieldConfig = [
    'template' => "{label}\n<div class=\"col-lg-2\">{input}</div>\n<div class=\"col-lg-4\">{error}</div>",
    'labelOptions' => ['class' => 'col-lg-2 control-label'],
];

$textFieldConfig = [
    'template' => "{label}\n<div class=\"col-lg-7\">{input}</div>\n<div class=\"col-lg-3\">{error}</div>",
    'labelOptions' => ['class' => 'col-lg-2 control-label'],
];

?>

<?php $form = ActiveForm::begin([
    'id' => 'post-form',
]); ?>
<div class="col-lg-9">
    <div class="panel panel-primary">
        <div class="panel-body">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'summary')->textarea(['maxlength' => true]) ?>
            <?= $form->field($model, 'content')->widget('kucha\ueditor\UEditor', []); ?>
        </div>
    </div>
</div>
<div class="col-lg-3">
    <div class="panel panel-primary">
        <div class="panel-body">
            <?= $form->field($model, 'category_id')->dropDownList(Category::getList()) ?>
            <?= $form->field($model, 'recommend')->dropDownList(Post::$recommendList) ?>
            <?= $form->field($model, 'status')->dropDownList(Post::$statusList) ?>
            <?= $form->field($model, 'tags')->textarea() ?>
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>
