<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = $model->name.' '.$model->surname;

$this->params['breadcrumbs'][] = 'Личный кабинет';

$dateBorn = new DateTime($model->date_born);
?>
<div class="users-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>
    <div class="row">
        <div class="col-lg-12">
            <p><?php echo $model->name; ?>  <?php echo $model->surname; ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <p><?php echo $model->login; ?> </p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <p><?php echo $dateBorn->format('d.m.Y'); ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <p><?php echo $model->email; ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <p><img width="200" src="/media/<?php echo $model->user_avatar; ?>" alt="<?php echo $model->login; ?>"></p>
        </div>
    </div>
</div>
