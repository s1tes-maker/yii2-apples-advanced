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
        <?php if(!empty($arr_apples)):
        $model = $arr_apples;
        foreach ($arr_apples as $apple): ?>
        <?php $apple->hours_after_fallout > Yii::$app->params['hours_freshness_apple'] ? $status = 'гнилое' : $status = $apple->status ?>
        <div class = "panel panel-default">
            <div class = "panel-heading" >
                <h4 class = "panel-heading" style="line-height: 1.5">
                    яблоко номер: <?= $apple->id ?><br>
                    цвет: <?= $apple->color ?><br>
                    статус: <?= $status ?><br>
                    <?php if(!empty($apple->size)): ?>
                        размер: <?= $apple->size ?><br>
                    <?php endif; ?>
                    дата появления: <?= $apple->appearance_date ?><br>
                    <?php if(!empty($apple->fallout_date)): ?>
                        дата падения: <?= $apple->fallout_date ?>
                    <?php endif; ?>
                </h4>
            </div>
        </div>
        <?php endforeach; endif;?>
    </div>
</div>
