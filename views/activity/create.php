<?php
?>
<h2>Создание события</h2>

<?php $form = \yii\bootstrap\ActiveForm::begin([]) ?>
<?=Yii::getAlias('@app');?><br>
<?=Yii::getAlias('@webroot');?><br>
<?=Yii::getAlias('@images');?><br>
    <?= $form->field($model, 'title') ?>
    <?= $form->field($model, 'description')->textarea() ?>
    <?= $form->field($model, 'dateStart')->input('date') ?>
    <?= $form->field($model, 'dateEnd')->input('date') ?>
    <?= $form->field($model, 'isBlocked')->checkbox() ?>
    <?= $form->field($model, 'isRepeatable')->checkbox() ?>
    <div class="form-group">
        <button class="btn btn-default" type="submit">Создать</button>
    </div>
<?php \yii\bootstrap\ActiveForm::end() ?>