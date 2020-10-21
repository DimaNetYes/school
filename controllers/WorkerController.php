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
            echo "<p style='color:red; font-size:33px;'>Доступ запрещен</p>"; die();
        }
//        Yii::$app->registration->login($worker);
    }

    public function actionDetailCab()
    {
        //Проверка работника
        if (!Yii::$app->user->isGuest && Yii::$app->user->identity->attributes['role'] == 2) {
            $appeal = Appeal::find()->where(['status' => 1])->one();
            $kindergarden = new Kindergarden();
            $kindergarden = $kindergarden->find()->all();
            $pka = new Pka();

            $kindergarden_id = $appeal->pka[0]->kindergarden->id;
            $pka->kindergarden_id = $kindergarden_id; //Что бы выбрался select автоматически;
//        print_r($_POST);
            if ($_POST['save']) {
                $appeal = Appeal::find()->where(['id' => $_POST['Appeal']['appeal_id']])->one();
                $appeal->status = 2;
                $kin = Kindergarden::findOne($kindergarden_id);
                $kin->capacity = $appeal->pka[0]->kindergarden->capacity - 1; //Уменьшение мест в садике
                $appeal->save();
                $kin->save();
                return $this->redirect('detail-cab');
            } elseif ($_POST['cancel']) {
                $appeal = Appeal::find()->where(['id' => $_POST['Appeal']['appeal_id']])->one();
                $appeal->status = $_POST['cancel'];
                $appeal->save();
                return $this->redirect('detail-cab');
            }

            if (empty($appeal)) {
                $appeal = new Appeal();
                return $this->render('detailCab', ['appeal' => $appeal, 'pka' => $pka, 'kindergarden' => $kindergarden, 'disabled' => 'disabled', 'capacity' => 'disabled']);
            } else {
                if ($pka->kindergarden->capacity > 0) {
                    return $this->render('detailCab', ['appeal' => $appeal, 'pka' => $pka, 'kindergarden' => $kindergarden, 'capacityC' => '3']);
                } else {
                    return $this->render('detailCab', ['appeal' => $appeal, 'pka' => $pka, 'kindergarden' => $kindergarden, 'capacityC' => '4', 'capacity' => 2]);
                }
            }
        }else{
            echo "<p style='color:red; font-size:33px;'>Доступ запрещен</p>"; die();
        }
    }
}