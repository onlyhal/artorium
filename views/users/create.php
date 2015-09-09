<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = 'Create Users';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-create">

    <h1><?= Html::encode($this->title) ?></h1>


    <div class="users-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'login')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'pass_hash')->passwordInput(['maxlength' => true])->label('Пароль') ?>

        <div class="form-group">
            <label class="control-label" for="repeat-pass-field">Повторите пароль:</label>
            <input type="password" id="repeat-pass-field"    class="form-control" name="repeat-pass-field" maxlength="">
        </div>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'email')->input('email') ?>



        <?= $form->field($model, 'date_born', [
            'inputOptions' => [
                'placeholder' => 'хуй',
                'class' => 'form-control datepicker',
            ]
        ])->textInput()->hint('yyyy-mm-dd') ?>

        <div class="form-group">
            <label class="control-label" for="Users[city_id]">Город:</label>
            <select name="Users[city_id]" class="form-control">
                <?php foreach($cities as $city): ?>
                <option value="<?php echo $city->id; ?>">
                    <?php echo $city->name;    ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
