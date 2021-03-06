<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Work Trades';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="work-trade-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Work Trade', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'work_id',
            'date_trade',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
