<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AppealGrid */

$this->title = 'Create Appeal Grid';
$this->params['breadcrumbs'][] = ['label' => 'Appeal Grids', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="appeal-grid-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
