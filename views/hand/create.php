<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Hand */

$this->title = 'Create Hand';
$this->params['breadcrumbs'][] = ['label' => 'Hands', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hand-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
