<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Works */

$this->title = 'Create Works';
$this->params['breadcrumbs'][] = ['label' => 'Works', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="works-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="works-form">

        <?php $form = ActiveForm::begin([
            'options' => [
                'enctype' => 'multipart/form-data',
            ]
        ]); ?>

        <?= $form->field($model, 'work_name')->textInput() ?>
        <input type="hidden" name="MAX_FILE_SIZE" value="4194304" />

        <?= $form->field($model, 'price')->textInput() ?>

        <?= $form->field($model, 'work_description')->textInput(['maxlength' => true]) ?>

        <input type="file" name="images[]" onchange="onFileSelect(this.value)" id="image" multiple>
        <div class="form-group">
            <?= Html::submitButton('Опубликовать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
<canvas height="320" width="480" id="canvas"></canvas>
<img id="previewImg">
<script>

        var canvas = document.getElementById('canvas');
        var context = canvas.getContext('2d');
        var x = 0;
        var y = 0;
        var width = 700;
        var height = 637;
        var imageObj = new Image();

        imageObj.onload = function() {
            context.drawImage(imageObj, x, y, width, height);
        };
        imageObj.src = 'http://www.html5canvastutorials.com/demos/assets/darth-vader.jpg';




    if(window.File && window.FileReader && window.FileList && window.Blob) {
        document.querySelector("input[type=file]").addEventListener("change", onFileSelect, false);
    } else {
        console.warn( "Ваш браузер не поддерживает FileAPI")
    }

</script>