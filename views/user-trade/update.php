<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserTrade */

$this->title = 'Update User Trade: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'User Trades', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-trade-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
