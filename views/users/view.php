<?php

use yii\helpers\Html;
use yii\helpers\BasicHelper;
/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = $model->name.' '.$model->surname;

$this->params['breadcrumbs'][] = 'Личный кабинет ('.$model->login.')';

$dateBorn = new DateTime($model->date_born);
?>
<div class="users-view">

    <div class="user-profile-img pull-left">
        <img src="/media/<?php echo $model->user_avatar; ?>" alt="<?php echo $model->login; ?>">
    </div>
    <h1><?php echo $model->login; ?> </h1>
    <p>
        <?= Html::a('', ['update', 'id' => $model->id], ['class' => 'glyphicon glyphicon-pencil user-edit-btn']) ?>
    </p>

            <p><?= Html::encode($this->title) ?></p>

            <p><?php echo $dateBorn->format('d.m.Y'); ?>
                <?php
//                echo $userAge.' '.BasicHelper::getYearsWord(25);
                ?></p>


            <p><?php echo $model->email; ?></p>

</div>
