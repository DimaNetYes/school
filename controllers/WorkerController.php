<?php


namespace app\controllers;


use app\models\Worker;
use yii\web\Controller;

class WorkerController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}