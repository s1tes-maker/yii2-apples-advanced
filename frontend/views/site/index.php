<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <?php $form = ActiveForm::begin(['action'=>'/']) ?>
        <?= Html::submitButton('Сгенерировать яблоки', ['class' => 'btn btn-primary btn-lg', 'value' => 'submit']) ?>
        <?php ActiveForm::end() ?>
        <h3>Время свежести яблок <?= Yii::$app->params['hours_freshness_apple']; ?> ч</h3>
    </div>

    <div class="body-content">

    </div>
</div>
