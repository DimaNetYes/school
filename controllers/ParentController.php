<?php


namespace app\controllers;


use app\models\Appeal;
use app\models\Pka;
use yii\web\Controller;

class ParentController extends Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAppealNew()
    {
        $model = new Appeal();
        $pka = new Pka();

        return $this->render('appealNew', ['model' => $model, 'pka' => $pka]);
    }

}