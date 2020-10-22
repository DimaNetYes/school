<?php

namespace app\controllers;

use app\models\Appeal;
use app\models\Registration;
use Yii;
use app\models\AppealGrid;
use app\models\AppealGridSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;

/**
 * AppealGridController implements the CRUD actions for AppealGrid model.
 */
class AppealGridController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all AppealGrid models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AppealGridSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

//        return $this->render('index', [
//            'searchModel' => $searchModel,
//            'dataProvider' => $dataProvider,
//            'model' => $model,
//            'appealsBefore' => $appealsBefore,
//            'capacity' => $capacity
//        ]);
        $pka = Registration::findOne(Yii::$app->user->identity->id)->pka;

        $appeal_id = [];
        foreach ($pka as $key => $val){
            array_push($appeal_id, $val->appeal_id);
        }
      

        $model = Appeal::findAll($appeal_id);

        //Заявок впереди
        $appealsBefore = [];
        foreach ($appeal_id as $val){
            $query = "SELECT * FROM appeal WHERE id <= :number AND status = 1";
            array_push($appealsBefore, count(Appeal::findBySql($query, [':number' => $val])->all()));
        }

        //Мест в саду
//            $parentKindergarden = Registration::findOne(Yii::$app->user->identity->id)->getPka()->with('kindergarden')->asArray()->all();
        $parentKindergarden = Registration::findOne(Yii::$app->user->identity->id)->pka;
        $capacity = [];
        foreach ($parentKindergarden as $key => $val){
            array_push($capacity, $val->kindergarden->capacity);
        }

//        echo "<pre>";
//        print_r($dataProvider);die;
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    /**
     * Displays a single AppealGrid model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AppealGrid model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AppealGrid();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing AppealGrid model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AppealGrid model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AppealGrid model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AppealGrid the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AppealGrid::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
