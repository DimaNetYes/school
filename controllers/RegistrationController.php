<?php


namespace app\controllers;

use app\models\Worker;
use app\models\ParentModel;
use app\models\Registration;
use app\models\LoginForm;
use yii\web\Controller;
use Yii;

class RegistrationController extends Controller
{
    public function actionIndex()
    {
        $model = new Registration();
        $login = new LoginForm();
        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $post = Yii::$app->request->post();
                //Запись в Registration
            $model->login = $post['Registration']['login'];
            $model->password = Yii::$app->security->generatePasswordHash($post['Registration']['password']);
            $model->name = $post['Registration']['name'];
            $model->role = $post['Registration']['role'];
            $model->save();

            $model->login($model); //сразу Login. Что бы разрешить доступ

                    //Запись в Parent ИЛИ Worker
            if($model->role == 1){
                $parent = new ParentModel();
                $parent->name = $post['Registration']['name'];
                $parent->login = $post['Registration']['login'];
                $parent->save();

                Yii::$app->session->setFlash('success', 'Данные приняты');
                Yii::$app->session->set('parent', $parent->id); //Передача родителя в сессии
                return $this->redirect('../parent/index');
            }else{
                $worker = new Worker();
                $worker->name = $post['Registration']['name'];
                $worker->login = $post['Registration']['login'];
                $worker->save();

                Yii::$app->session->setFlash('success', 'Данные приняты');
                return $this->redirect('../worker/index');
            }

        }


        return $this->render('index', ['model' => $model]);
    }


    public function actionLogout()
    {
        Yii::$app->user->logout();
        $model = new LoginForm();
        return $this->render('login', ['model' => $model]);
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            if(Yii::$app->user->identity->role == 1){
                return $this->redirect('../parent/index');
            }elseif(Yii::$app->user->identity->role == 2){
                return $this->redirect('../worker/index');
            }
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if(Yii::$app->user->identity->role == 1){
                return $this->redirect('../parent/index');
            }elseif(Yii::$app->user->identity->role == 2){
                return $this->redirect('../worker/index');
            }
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionMLogin()
    {
        //if() Если пользователь вошел, то не провер\ть
        $worker = Registration::find()->orderBy(['id' => SORT_DESC])->one();
        print_r($worker->validatePassword('ccc')); //Валидация
    }

}