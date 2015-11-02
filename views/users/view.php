<?php

use yii\helpers\Html;
use yii\helpers\BasicHelper;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = $model->name.' '.$model->surname;

$this->params['breadcrumbs'][] = 'Личный кабинет ('.$model->login.')';

$dateBorn = new DateTime($model->date_born);
?>
<div class="users-view">
    <div class="user-profile-img pull-left">
<?php
$session = Yii::$app->session;
if (isset($session['eauth_profile'])) {
    if ($session['eauth_profile']['app'] == 'fb') {
        $photo = 'http://graph.facebook.com/' . $session['eauth_profile']['id'] . '/picture?width=500&height=500';
    } else if ($session['eauth_profile']['app'] == 'vk') {
        $photo = $session['eauth_profile']['photo_big'];
    }

    ?>
    <img src="<?= $photo ?>" alt="<?= $session['eauth_profile']['name'] ?>">
    <?php
} else {
    ?>
    <img src="/media/<?php echo $model->user_avatar; ?>" alt="<?php echo $model->login; ?>">
    <?php
}
        ?>
    </div>
    <h1><?php
        //var_dump($session['eauth_profile']);
        echo $model->login; ?> </h1>
    <p>
        <?= Html::a('', ['update', 'id' => $model->id], ['class' => 'glyphicon glyphicon-pencil user-edit-btn']) ?>
    </p>

            <p><?= Html::encode($this->title) ?></p>

            <p><?php echo $dateBorn->format('d.m.Y'); ?>
                <?php
                    echo $userAge.' '.BasicHelper::getYearsWord($userAge);
                ?></p>


            <p><?php echo $model->email; ?></p>
    <a class="btn btn-success" href="<?php echo Url::toRoute('/works/index');?>">Добавить работу</a>
</div>
