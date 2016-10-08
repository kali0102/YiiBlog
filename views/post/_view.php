<?php
use yii\helpers\Html;

?>
<blockquote>
    <h4><?= Html::a($model->title, ['/post/view', 'id' => $model->id]) ?></h4>
    <p><?= $model->summary; ?></p>
    <footer><?= $model->user->username; ?> 发布于 <i><?= date("Y/m/d H:i", $model->update_time) ?></i></footer>
</blockquote>