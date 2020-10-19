<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="container">
    <h1>Кабинет родителей</h1>
    <h3>Новая заявка</h3>
    <?php

$items=[
    4=>'Детсад #1',
    5=>'Детсад №2',
    10=>'Детсад №3',
    16=>'Детсад №4',
];

                //Нужно вставить обратно model и добавиьт поле kindergarden
    $form = ActiveForm::begin(['options' => ['class' => 'form-group', 'method' => 'post']]);
    echo $form->field($model, 'childName')->label('Имя');
    echo $form->field($model, 'birthday')->input('date', ['class' => 'form-control'])->label('Дата рождения');
    echo $form->field($pka, 'kindergarden_id')->dropDownList($items)->label('Детсад');
//    echo $form->field($pka, 'parent_id')->input('Детсад');
//    echo $form->field($pka, 'appeal_id')->dropDownList($items)->label('Детсад');
    echo Html::submitButton('Добавить', ['class' => 'btnSuccess']);
    ActiveForm::end();
    ?>

</div>





