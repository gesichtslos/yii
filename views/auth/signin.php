<?php

/**
 * Created by PhpStorm.
 * User: 3G
 * Date: 01.08.2019
 * Time: 19:29
 */

/* @var $this \yii\web\View */
/* @var $model \app\models\Users */
?>
<div class="row">
    <div class="col-md-6">
        <h2>Авторизация</h2>
        <?php $form = \yii\bootstrap\ActiveForm::begin(); ?>
        <?= $form->field($model, 'email'); ?>
        <?= $form->field($model, 'password')->passwordInput(); ?>
        <div class="form-group">
            <button type="submit" class="btn btn-default">Авторизация</button>
        </div>
        <?php \yii\bootstrap\ActiveForm::end(); ?>
    </div>
</div>