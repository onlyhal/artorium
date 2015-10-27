<?php

namespace app\controllers;

use Yii;
use app\models\Works;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use  yii\web\Session;
use yii\helpers\BasicHelper;

/**
 * WorksController implements the CRUD actions for Works model.
 */
class WorksController extends Controller
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
     * Lists all Works models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Works::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Works model.
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
     * Creates a new Works model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $session = new Session;
        $session->open();

        if($session['user_login']){
            $model = new Works();
            $currentUser = BasicHelper::getUserByLogin($session['user_login']);
            if ($model->load(Yii::$app->request->post()) && $model->save()) {

                if($_FILES['images'] != ''){
//                    $uploaddir = '../media/users_photo/';
                    var_dump($_FILES);
                    echo '<br>=====================<br>';
                    foreach($_FILES['images'] as $image):
                        var_dump($image);
                        echo '<br>=====================<br>';
                    endforeach;
//                    $newFileName = date('YmdHis') . rand(10, 100) . '.jpg';
//                    $uploadfile = $uploaddir . $newFileName;
//
//                    if(move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)){
//                        $model->user_avatar = 'users_photo/'.$newFileName;
//                    }
                }
                die();
                $model->user_id = $currentUser->id;
                $model->date = date('Y-m-d H:i:s');
                $model->src_image = 's';
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }else{
            return $this->goHome();
        }

    }

    /**
     * Updates an existing Works model.
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
     * Deletes an existing Works model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Works model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Works the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Works::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
