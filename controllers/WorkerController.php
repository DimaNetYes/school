<?php


namespace app\controllers;


use app\models\Kindergarden;
use app\models\Pka;
use app\models\Registration;
use app\models\Worker;
use app\models\Appeal;
use yii\web\Controller;
use Yii;

class WorkerController extends Controller
{
    public function actionIndex()
    {
              //Проверка работника
        if(!Yii::$app->user->isGuest && Yii::$app->user->identity->attributes['role'] == 2){
            $appeals = Appeal::find()->where(['status' => 1])->all();
            $countAppeals = count($appeals);
            return $this->render('index', ['countAppeals' => $countAppeals]);
        }else{
            echo "Доступ запрещен";
        }
//        Yii::$app->registration->login($worker);
    }

    public function actionDetailCab()
    {
        $appeal = Appeal::find()->where(['status' => 1])->one();
//        print_r($appeal);
        $kindergarden = new Kindergarden();
        $kindergarden = $kindergarden->find()->all();
        $pka = new Pka();
        $kindergarden_id = $pka->find()->select('kindergarden_id')->where(['appeal_id' => $id])->asArray()->one()['kindergarden_id'];
        $pka->kindergarden_id = $kindergarden_id; //Что бы выбрался select автоматически;

        if($_POST['save']){
            $appeal = Appeal::find()->where(['id' => $_POST['Appeal']['appeal_id']])->one();
            $appeal->status = 2;
            print_r($kindergarden_id = $pka->find()->select('kindergarden_id')->where(['appeal_id' => $id])->asArray()->one()['kindergarden_id']);
//            $appeal->save();
            return $this->redirect('detail-cab');
        }elseif($_POST['cancel']){
            $appeal = Appeal::find()->where(['id' => $_POST['Appeal']['appeal_id']])->one();
            $appeal->status = 3;
            $appeal->save();
            return $this->redirect('detail-cab');
        }




        return $this->render('detailCab', ['appeal' => $appeal, 'pka' => $pka, 'kindergarden' => $kindergarden]);
    }

    public function actionS()
    {
//        $worker = Registration::find()->orderBy(['id' => SORT_DESC])->one();
//        echo "<pre>";
//        print_r($worker->validatePassword('ccc'));
//        echo "</pre>";
    }
}