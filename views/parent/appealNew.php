<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->params['breadcrumbs'][] = array(
    'label'=> 'Заявки',
);

?>

<div class="container">
    <h1>Кабинет родителей</h1>
    <h3>Новая заявка</h3>
    <?php

$items = [];
foreach ($kindergarden as $key => $val) {
    if($val->capacity > 0) {
        $items[$val->id] = $val->name;
    }
}
//print_r($kindergarden);
                //Нужно вставить обратно model и добавиьт поле kindergarden
    $form = ActiveForm::begin(['options' => ['class' => 'form-group', 'method' => 'post', 'action' => ['parent/appeal-new']]]);
    echo $form->field($model, 'childName')->label('Имя');
    echo $form->field($model, 'birthday')->input('date', ['class' => 'form-control'])->label('Дата рождения');
    echo $form->field($pka, 'kindergarden_id')->dropDownList($items)->label('Детсад');
    echo Html::submitButton('Добавить', ['class' => 'btnSuccess']);
    ActiveForm::end();
    ?>

</div>





