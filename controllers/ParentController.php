<?php


namespace app\controllers;


use app\models\Appeal;
use app\models\Kindergarden;
use app\models\Pka;
use app\models\Registration;
use yii\web\Controller;
use Yii;

class ParentController extends Controller
{

    public function actionIndex()
    {
        //Проверка работника
//        print_r(Yii::$app->user);
        if(!Yii::$app->user->isGuest && Yii::$app->user->identity->attributes['role'] == 1){
                //Выбирают из табл. PKA appeal_id равные parent_id
            $pka = Pka::find()->select(['appeal_id'])->where(['parent_id' => Registration::find()->select('id')->where(['login' => $login = Yii::$app->user->identity->login])->one()['id']])->all();
            $appeal_id = [];
            foreach ($pka as $key => $val){
                array_push($appeal_id, $val->appeal_id);
            }

            $model = Appeal::findAll($appeal_id);

            //Заявок впереди
            $appealsBefore = [];;
            foreach ($appeal_id as $val){
                $query = "SELECT * FROM appeal WHERE id < :number AND status = 1";
                array_push($appealsBefore, count(Appeal::findBySql($query, [':number' => $val])->all()));
            }

            return $this->render('index', ['model' => $model, 'appealsBefore' => $appealsBefore]);
        }else{
            echo "Доступ запрещен";
        }

    }

    public function actionAppealNew()
    {
        $model = new Appeal();
        $pka = new Pka();
        $kindergarden = new Kindergarden();
        $kindergarden = $kindergarden->find()->all();


        if($model->load(Yii::$app->request->post())){

            $post = Yii::$app->request->post();

            $lastAppeal = Appeal::find()->orderBy(['id' => SORT_DESC])->one(); //Последняя запись в appeal, для number
            $model->number = $lastAppeal['number'] + 1;
            $model->date = date("Y-m-d");
            $model->childName = $post['Appeal']['childName'];
            $model->birthday = $post['Appeal']['birthday'];
            $model->status = 1;
            $model->save();

            $login = Yii::$app->user->identity->login;
            $pka->parent_id = Registration::find()->select('id')->where(['login' => $login])->one()['id'];
            $pka->kindergarden_id = $post['Pka']['kindergarden_id'];
            $pka->appeal_id = $lastAppeal['id'] + 1;
            $pka->save();
//            print_r($pka);

            Yii::$app->session->setFlash('success', 'Заявка успешно создана');
            return $this->redirect('../parent');
        }


        return $this->render('appealNew', ['model' => $model, 'pka' => $pka, 'kindergarden' => $kindergarden]);
    }

    public function actionDetailCab()
    {
                    //отправка во view
        $id = htmlentities(strip_tags(trim($_GET['id'])));
        $appeal = Appeal::find()->where(['id' => $id])->one();
        $kindergarden = new Kindergarden();
        $kindergarden = $kindergarden->find()->all();
        $pka = new Pka();
        $kindergarden_id = $pka->find()->select('kindergarden_id')->where(['appeal_id' => $id])->asArray()->one()['kindergarden_id'];
        $pka->kindergarden_id = $kindergarden_id; //Что бы выбрался select автоматически

//        print_r($_POST['Appeal']['appeal_id']);

                    //Получение
        if($_POST['delete']){
                //Удаление из pka
            $pka = Pka::find()->where(['appeal_id' => $_POST['Appeal']['appeal_id']])->one();
            $pka->delete();
                //Удаление из appeal
            $appeal = Appeal::find()->where(['id' => $_POST['Appeal']['appeal_id']])->one();
            $appeal->delete();
            return $this->redirect('index');
        }elseif($_POST['save']){
            $kindergarden_id = $_POST['Pka']['kindergarden_id'];
            $pka = Pka::find()->where(['appeal_id' => $_POST['Appeal']['appeal_id']])->one();
            $pka->kindergarden_id = $kindergarden_id;
            $pka->save();
            return $this->redirect('index');
        }

        return $this->render('detailCab', compact('appeal', 'kindergarden', 'pka'));
    }

}