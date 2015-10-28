<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = 'Sign in';

$this->params['breadcrumbs'][] = $this->title;
?>

<?php
if (Yii::$app->getSession()->hasFlash('error')) {
    echo '<div class="alert alert-danger">'.Yii::$app->getSession()->getFlash('error').'</div>';
}
?>

<p class="lead">Do you already have an account on one of these sites? Click the logo to log in with it here:</p>
<?php echo \nodge\eauth\Widget::widget(array('action' => 'users/signin')); ?>

<?php if(isset($errorCode) && $errorCode == 1){ ?>
    <div class="alert alert-danger">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        Неправильный логин или пароль. Проверьте правильность вводимых данных
    </div>
<?php }?>
<div class="users-create">

    <h1><?= Html::encode($this->title) ?></h1>


    <div class="users-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'login')->textInput(['maxlength' => true])->label('Логин') ?>

        <?= $form->field($model, 'pass_hash')->passwordInput(['maxlength' => true])->label('Пароль') ?>

        <div class="form-group">
            <?= Html::submitButton('Войти', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
