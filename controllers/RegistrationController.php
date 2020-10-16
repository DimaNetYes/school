<?php


namespace app\controllers;

use app\models\Worker;
use app\models\ParentModel;
use app\models\Registration;
use yii\web\Controller;
use Yii;

class RegistrationController extends Controller
{
    public function actionIndex()
    {
        $model = new Registration();

        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $post = Yii::$app->request->post();
                //Запись в Registration
            $model->login = $post['Registration']['login'];
            $model->password = $post['Registration']['password'];
            $model->name = $post['Registration']['name'];
            $model->role = $post['Registration']['role'];
            $model->save();
                    //Запись в Parent ИЛИ Worker
            if($model->role == 1){

                $parent = new ParentModel();
                $parent->name = $post['Registration']['name'];
                $parent->login = $post['Registration']['login'];
                $parent->save();

//                $model = new ParentModel();
//                Yii::$app->session->set('model', $model); //Для передачи модели в view
                Yii::$app->session->setFlash('success', 'Данные приняты');
                return $this->redirect('../parent/index');
            }else{
                $worker = new Worker();
                $worker->name = $post['Registration']['name'];
                $worker->login = $post['Registration']['login'];
                $worker->save();
            }

        }


        return $this->render('index', ['model' => $model]);
    }

}