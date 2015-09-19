<?php

namespace app\controllers;

use app\models\Cities;
use Yii;
use app\models\Users;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class UsersController extends Controller
{
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
        $dataProvider = new ActiveDataProvider([
            'query' => Users::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Users model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
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

        if ($model->load(Yii::$app->request->post()) && $model->save(   )) {
            $model->date_reg = date('Y-m-d H:i:s');
            $model->pass_hash = md5( $_POST['Users']['pass_hash'] );
            $model->city_id = $_POST['Users']['city_id'];
            $model->save(true);

            return $this->redirect(['view', 'id' => $model->id]);

        } else {
            $cities_model = Cities::find()->all();
            return $this->render('create', [
                'cities' => $cities_model,
                'model' => $model,
            ]);
        }
//        $session = new Session;
//        $session->open();
//        $session['name1'];
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
    protected function checkData(){
        if(2 == 2){
            return true;
        }
    }
    public function actionSignin(){
        $model = new Users();

        if ($model->load(Yii::$app->request->post()) && $this->checkData()) {
           $modelNew = Users::find()
               ->where([
                   'login' => $model->login,
                   'pass_hash' => md5($model->pass_hash),
               ])->one();

             if(!$modelNew){
                 return $this->render('signin', [
                     'model' => $model,
                 ]);
             }else{
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
