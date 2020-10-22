<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AppealGrid */

$this->title = 'Update Appeal Grid: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Appeal Grids', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="appeal-grid-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
