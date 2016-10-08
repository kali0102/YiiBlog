<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Post;
use app\models\Category;

/* @var $this yii\web\View */
/* @var $model app\models\PostSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['class' => 'form-inline'],
        'fieldConfig' => ['template' => "{label}{input}"],
    ]); ?>

    <?= $form->field($model, 'title')->textInput([
        'class' => 'form-control input-sm',
        'placeholder' => '文章的标题'
    ])->label('文章标题:');
    ?>

    <?= $form->field($model, 'category_id')
        ->dropDownList(Category::getList(),
            [
                'class' => 'form-control input-sm',
                'prompt' => '-选择分类-'
            ]
        )->label('分类:');
    ?>

    <?= $form->field($model, 'status')
        ->dropDownList(Post::$statusList,
            [
                'class' => 'form-control input-sm',
                'prompt' => '-选择状态-'
            ]
        )->label('状态:');
    ?>

    <div class="form-group">
        <?= Html::submitButton('搜索', ['class' => 'btn btn-sm btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
