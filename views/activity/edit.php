<?php
?>
    <h2>Редактирование события</h2>

<?php $form = \yii\bootstrap\ActiveForm::begin([]) ?>
<?= Yii::getAlias('@app'); ?><br>
<?= Yii::getAlias('@webroot'); ?><br>
<?= Yii::getAlias('@images'); ?><br>
<?= $form->field($model, 'title') ?>
<?= $form->field($model, 'description')->textarea() ?>
<?= $form->field($model, 'dateStart')->input('text') ?>
<?= $form->field($model, 'dateEnd')->input('text') ?>
<?= $form->field($model, 'isBlocked')->checkbox() ?>
<?= $form->field($model, 'isRepeatable')->checkbox() ?>
<?= $form->field($model, 'repeatType')->dropDownList($model::REPEAT_TYPE) ?>
<?= $form->field($model, 'useNotification')->checkbox() ?>
<?= $form->field($model, 'email', ['enableAjaxValidation' => true, 'enableClientValidation' => false]) ?>
<?= $form->field($model, 'emailRepeat') ?>
    <div class="form-group">
        <button class="btn btn-default" type="submit">Изменить</button>
    </div>
<?php \yii\bootstrap\ActiveForm::end() ?>