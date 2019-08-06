<?php
?>
<div class="row">
    <div class="col-md-6">
        <?=\app\widgets\DaoUserWidget\DaoUserWidget::widget(['user' => $users])?>
    </div>
    <div class="col-md-6">
        <?=\app\widgets\DaoUserWidget\DaoUserWidget::widget(['user' => $activity])?>
    </div>
    <div class="col-md-6">
        <?=\app\widgets\DaoUserWidget\DaoUserWidget::widget(['user' => $act])?>
    </div>
    <div class="col-md-6">
        <?=\app\widgets\DaoUserWidget\DaoUserWidget::widget(['user' => $count])?>
    </div>
</div>
