<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;
use  yii\web\Session;
$session = new Session;
$session->open();

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => 'Art',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
        ?>
        <ul>
                <?php
                    if(!$session['user_login']){
                ?>
            <li>
                <a href="<?php echo Url::toRoute('/users/create');?>">Sign Up</a>
            </li>
            <li>
                <a href="<?php echo Url::toRoute('/users/signin');?>">Sign In</a>
            </li>
            <?php
                }else{
            ?>
            <li>
                <a href="<?php echo Url::toRoute(['/users/view/', 'id' => $session['user_id']]);?>"><?php echo $session['user_login'] ?></a>
            </li>
            <li>
                <a href="<?php echo Url::toRoute('/users/logout');?>">Logout</a>
            </li>
            <?php
            }?>
        </ul>
        <?php
            NavBar::end();
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
