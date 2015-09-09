<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Trades */

$this->title = 'Create Trades';
$this->params['breadcrumbs'][] = ['label' => 'Trades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trades-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
