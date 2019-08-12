<?php
?>
<div class="row">
    <?php if ($this->beginCache('user_list', ['duration' => 20])): ?>
        <div class="col-md-6">
            <?= \app\widgets\DaoUserWidget\DaoUserWidget::widget(['user' => $users]) ?>
        </div>
    <?php $this->endCache(); endif; ?>
    <div class="col-md-6">
        <?= \app\widgets\DaoUserWidget\DaoUserWidget::widget(['user' => $activity]) ?>
    </div>
    <div class="col-md-6">
        <?= \app\widgets\DaoUserWidget\DaoUserWidget::widget(['user' => $act]) ?>
    </div>
    <div class="col-md-6">
        <?= \app\widgets\DaoUserWidget\DaoUserWidget::widget(['user' => $count]) ?>
    </div>
    <div class="col-md-6">
    <pre>
      <p>DataReader: </p><br>
      <?php
      foreach ($reader as $value) {
          print_r($value);
      }
      ?></pre>
    </div>
</div>
