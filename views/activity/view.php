<?php
/** @var \app\models\Activity $model ... */
?>
<a href="#">Календарь</a>
<p>Заголовок: <strong><?= $model->title ?></strong></p>
<p>Описание: <strong><?= $model->description ?></strong></p>
<p>Создал: <strong><?= $model->user->email ?></strong></p>
<p>Дата создания: <strong><?= $model->getDateCreated(); ?></strong></p>

<?php //if ($model->image): foreach ($model->image as $image): ?>
<!--    <img src="/images/--><? //= $image ?><!--" width="300"><br>-->
<?php //endforeach; endif; ?>
<!--<a href="#">Редактировать</a>-->
