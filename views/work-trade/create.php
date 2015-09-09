<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\WorkTrade */

$this->title = 'Create Work Trade';
$this->params['breadcrumbs'][] = ['label' => 'Work Trades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="work-trade-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
