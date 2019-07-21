<?php
?>
    <h2>Создние дня</h2>

<?php $form = \yii\bootstrap\ActiveForm::begin([]) ?>
    <?= $form->field($model, 'title') ?>
    <?= $form->field($model, 'workday')->checkbox() ?>
    <?= $form->field($model, 'actions') ?>
    <div class="form-group">
        <button class="btn btn-default" type="submit">Создать</button>
    </div>
<?php \yii\bootstrap\ActiveForm::end() ?>