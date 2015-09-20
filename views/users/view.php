<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use  yii\web\Session;
$session = new Session;
$session->open();

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if($session['user_login']){ echo 'Идентификатор из сессии: '.$session['user_login']; }?>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

  <?php echo $model->name; ?>
  <?php echo $model->surname; ?>
  <?php echo $model->login; ?>
  <?php echo $model->date_born; ?>
  <?php echo $model->email; ?>
  <?php echo date('Y-m-d') - $model->date_reg; ?>
</div>
