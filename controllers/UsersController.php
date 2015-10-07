<?php

namespace app\controllers;

use app\models\Cities;
use Yii;
use app\models\Users;
use yii\helpers\ArtHelpers;
use yii\helpers\BasicHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Session;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class UsersController extends Controller
{
    public function get_ages ($date_from, $date_till) {
        $date_from = explode('-', $date_from);
        $date_till = explode('-', $date_till);

        $time_from = mktime(0, 0, 0, $date_from[1], $date_from[2], $date_from[0]);
        $time_till = mktime(0, 0, 0, $date_till[1], $date_till[2], $date_till[0]);

        $diff = ($time_till - $time_from)/60/60;

        return $diff;
    }

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Users models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->goHome();
    }

    /**
     * Displays a single Users model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $userModel = $this->findModel($id);
//        $currentDate = get_ages (date('Y-m-d'), $userModel->date_born);
        return $this->render('view', [
            'model' => $userModel,
            'userAge' => BasicHelper::getDateDiff(date('Y-m-d'), $userModel->date_born)
        ]);
    }

    /**
     * Creates a new Users model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Users();

        if ($model->load(Yii::$app->request->post()) && $model->save(true)) {
            $model->date_reg = date('Y-m-d H:i:s');

            $model->city_id = $_POST['Users']['city_id'];

            if($_FILES['image']['tmp_name'] != ''){
                $uploaddir = '../media/users_photo/';
                $newFileName = date('YmdHis') . rand(10, 100) . '.jpg';
                $uploadfile = $uploaddir . $newFileName;

                if(move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)){
                    $model->user_avatar = 'users_photo/'.$newFileName;
                }
            }
            $model->pass_hash = md5( $model->pass_hash );
            $model->password_repeat = md5( $model->pass_hash );
            $model->save(false); //we don't need second validation. Returns error if 'true'

            return $this->redirect(['view', 'id' => $model->id]);

        } else {
            $cities_model = Cities::find()->all();
            return $this->render('create', [
                'cities' => $cities_model,
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Users model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    public function actionSignin(){
        $model = new Users();

        if ($model->load(Yii::$app->request->post())) {
           $modelNew = Users::find()
               ->where([
                   'login' => $model->login,
                   'pass_hash' => md5($model->pass_hash),
               ])->one();

             if(!$modelNew){
                 return $this->render('signin', [
                     'model' => $model,
                     'errorCode' => 1
                 ]);
             }else{
                 $session = new Session;
                 $session->open();
                 $session['user_login'] = $model->login;
                 return $this->render('view', [
                     'model' => $modelNew
                 ]);
             }
        } else {
            return $this->render('signin', [
                'model' => $model,
            ]);
        }
    }
    public function actionLogout(){
        $session = new Session;
        $session->open();
        unset($session['user_login']);
        return $this->goHome();
    }
    /**
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
