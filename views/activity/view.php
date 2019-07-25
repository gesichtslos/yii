<?php
/** @var \app\models\Activity $model ... */
?>
<a href="#">Календарь</a>
<p>Заголовок <strong><?= $model->title ?></strong></p>
<p>Описание <strong><?= $model->description ?></strong></p>

<?php if ($model->image): foreach ($model->image as $image): ?>
    <img src="/images/<?= $image ?>" width="300"><br>
<?php endforeach; endif; ?>
<a href="#">Редактировать</a>
