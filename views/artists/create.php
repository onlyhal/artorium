<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Artists */

$this->title = 'Create Artists';
$this->params['breadcrumbs'][] = ['label' => 'Artists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="artists-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
