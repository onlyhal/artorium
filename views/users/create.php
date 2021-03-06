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
    <!--div id="fb-root"></div>

    <div class="fb-login-button" data-max-rows="1" data-size="medium" data-show-faces="false" data-auto-logout-link="true" onlogin="checkLoginState();"></div>
    <script>

        // This is called with the results from from FB.getLoginStatus().
        function statusChangeCallback(response) {
            console.log('statusChangeCallback');
            console.log(response);
            // The response object is returned with a status field that lets the
            // app know the current login status of the person.
            // Full docs on the response object can be found in the documentation
            // for FB.getLoginStatus().
            if (response.status === 'connected') {
                // Logged into your app and Facebook.
                testAPI();
            } else if (response.status === 'not_authorized') {
                // The person is logged into Facebook, but not your app.
                document.getElementById('status').innerHTML = 'Please log ' +
                    'into this app.';
            } else {
                // The person is not logged into Facebook, so we're not sure if
                // they are logged into this app or not.
                document.getElementById('status').innerHTML = 'Please log ' +
                    'into Facebook.';
            }
        }

        // This function is called when someone finishes with the Login
        // Button.  See the onlogin handler attached to it in the sample
        // code below.
        function checkLoginState() {
            FB.getLoginStatus(function(response) {
                statusChangeCallback(response);
            });
        }

        window.fbAsyncInit = function() {
            FB.init({
                appId      : '938925966188399',
                cookie     : true,  // enable cookies to allow the server to access
                                    // the session
                xfbml      : true,  // parse social plugins on this page
                version    : 'v2.5' // use version 2.2
            });

            FB.getLoginStatus(function(response) {
                statusChangeCallback(response);
            });

        };

        // Load the SDK asynchronously
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

        // Here we run a very simple test of the Graph API after login is
        // successful.  See statusChangeCallback() for when this call is made.
        function testAPI() {
            console.log('Welcome!  Fetching your information.... ');
            FB.api('/me?fields=name,first_name,last_name,birthday,email,hometown,picture', function(response) {
                console.log(JSON.stringify(response));
                console.log(response.picture.data.url);
                //console.log('Successful login for: ' + response.name);
                document.getElementById('status').innerHTML =
                    'Thanks for logging in, ' + response.name + '!';
            });
        }

    </script-->


    <div class="users-form">

        <?php $form = ActiveForm::begin([
            'options' => [
                'enctype' => 'multipart/form-data',
            ]
        ]);

        $session = Yii::$app->session;
        if (isset($session['eauth_profile'])) {
            ?>
            <p class="lead">Вы ещё не зарегестрированы на artorium!? O_o</p>
            <?php
            //var_dump($session['eauth_profile']);
            $facebook_birthday = $session['eauth_profile']['birthday'];
            $facebook_birthday = explode("/", $facebook_birthday);
            //var_dump($facebook_birthday);
            $facebook_birthday = $facebook_birthday[2] . '-' . $facebook_birthday[0] . '-' . $facebook_birthday[1];
        }
       // }
        ?>

        <?= $form->field($model, 'login')->textInput(['maxlength' => true, 'value' => $session['eauth_profile']['first_name'].'.'.$session['eauth_profile']['last_name']]) ?>

        <?= $form->field($model, 'pass_hash')->passwordInput(['maxlength' => true])->label('Пароль') ?>

        <?= $form->field($model, 'password_repeat')->passwordInput(); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'value' => $session['eauth_profile']['first_name']]) ?>

        <?= $form->field($model, 'surname')->textInput(['maxlength' => true, 'value' => $session['eauth_profile']['last_name']]) ?>

        <?= $form->field($model, 'email')->textInput(['email', 'value' => $session['eauth_profile']['email']]) ?>

        <input type="hidden" name="MAX_FILE_SIZE" value="4194304" />

        <?= $form->field($model, 'date_born', [
            'inputOptions' => [
                'placeholder' => 'хуй',
                'class' => 'form-control datepicker',
            ]
        ])->textInput([ 'value' => $facebook_birthday])->hint('yyyy-mm-dd') ?>

        <div class="form-group">
            <label class="control-label" for="Users[city_id]">Город:</label>
            <select name="Users[city_id]" class="form-control">
                <?php foreach($cities as $city): ?>
                <option value="<?php echo $city->id; ?>">
                    <?php echo $city->name; ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>
        <input type="file" name="image" id="image">
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
