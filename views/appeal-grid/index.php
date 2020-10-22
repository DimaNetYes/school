<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

//use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use app\models\Appeal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AppealGridSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Appeal Grids';
$this->params['breadcrumbs'][] = $this->title;

//echo "<pre>";
//print_r($data);die;
?>
<div class="appeal-grid-index">

    <h1>Кабинет родителей</h1>


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<!--    --><?//= GridView::widget([
//        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
//        'showFooter' => false,
//        'rowOptions' => function($model, $key, $index){
//            return [
//                'class' => ($index % 1 == 0) ? 'stripShow' : ''
//            ];
//        },
//        'layout' => "{errors}\n{items}\n{pager}",
//        'columns' => [
////            ['class' => 'yii\grid\SerialColumn'],
//
//            [
//                'attribute' => 'number',
//                'label' => '#',
//                'value' => function($model){
//                    return  $model->id;
//                },
//                'contentOptions' => function($model){
//                    return [
//                        'class' => (empty($model->id)) ? 'empty-cell' : ''
//                    ];
//                },
//            ],
//            [
//                'attribute' => 'date',
//                'label' => 'Дата подачи',
//                'contentOptions' => function($model){
//                    return [
//                        'class' => (empty($model->date)) ? 'empty-cell' : ''
//                    ];
//                },
//            ],
//            [
//                    'attribute' => 'childName',
//                    'label' => 'Ребенок',
//                    'format' => 'raw',
//                    'value' => function($model){
//                        return Html::a($model->childName . ' ' . $model->birthday, ['/parent/detail-cab', 'id' => $model->id]);
//                    },
//            ],
//            [
//                'attribute' => 'status',
//                'label' => 'Статус',
//                'value' => function($data) {
//                    return $data->statusCode[$data->status];
//                },
//                'filter'    => [ "1"=>"open", "2"=>"in progress", "3"=>"closed" ]
//            ],
//            [
//                'label' => 'Заявок впереди',
////                'value' =>  $appealsBefore[0]
//            ],
//            [
//
//                'label' => 'Мест в саду',
//            ],
//
//            ['class' => 'yii\grid\ActionColumn'],
//        ],
//    ]); ?>
<!--    <p>-->
<!--        --><?//= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
<!--    </p>-->


<?php

    echo GridView::widget([
        'dataProvider' => $dataProvider,
    ]);
?>

    <style>
        .succes{
            background: lightgreen;
        }
        .cancel{
            background: lightred;
        }
        .watch{
            background: lightblue;
        }
        .empty-cell{
            background: #c12e2a;
        }
        .headerCustomRow, .headerCustomRow th, .headerCustomRow a{
            background: #337ab7;
            color: #fff;
        }
        .stripShow{
            background: #e9f1ff
        }
    </style>

</div>
