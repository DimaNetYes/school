<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="container">
    <h1>Кабинет родителей</h1>
    <h3>
        Заявка
        <?php
            $status = [1 => 'На рассмотрении', 2 => 'Принята', 3 => 'Отклонена', 4 => 'Нет мест'];
            echo '#' . $appeal->number . ' от ' . str_replace("-", ".", $appeal->date) . ' (' . $status[$appeal->status] . ')';
//            print_r($appeal->id);
        ?>
    </h3>
    <?php
    if($appeal->status == 1) {  //На рассмотрении
        $items = [];
        foreach ($kindergarden as $key => $val) {
            $items[$val->id] = $val->name;
        }

        $form = ActiveForm::begin(['options' => ['class' => 'form-group', 'method' => 'post']]);
        echo $form->field($appeal, 'childName')->input('text', ['readonly' => true])->label('Имя');
        echo $form->field($appeal, 'birthday')->input('date', ['class' => 'form-control', 'readonly' => true])->label('Дата рождения');
        echo $form->field($appeal, 'appeal_id')->hiddenInput(['value' => $appeal->id]);
        echo $form->field($pka, 'kindergarden_id')->dropDownList($items)->label('Детсад');
        echo Html::submitButton('Сохранить', ['class' => 'btnSave', 'name' => 'save', 'value' => 1]);
        echo Html::submitButton('Удалить', ['class' => 'btnDelete', 'name' => 'delete', 'value' => 2]);
        ActiveForm::end();
    }elseif($appeal->status == 2) {  //Отклонена
        $items = [];
        foreach ($kindergarden as $key => $val) {
            $items[$val->id] = $val->name;
        }

        $form = ActiveForm::begin(['options' => ['class' => 'form-group', 'method' => 'post']]);
        echo $form->field($appeal, 'childName')->input('text', ['readonly' => true])->label('Имя');
        echo $form->field($appeal, 'birthday')->input('date', ['class' => 'form-control', 'readonly' => true])->label('Дата рождения');
        echo $form->field($pka, 'kindergarden_id')->dropDownList($items, ['disabled' => true])->label('Детсад');
        ActiveForm::end();
    }elseif($appeal->status == 4) {  //Не осталось мест
        $items = [];
        foreach ($kindergarden as $key => $val) {
            $items[$val->id] = $val->name;
        }

        $form = ActiveForm::begin(['options' => ['class' => 'form-group', 'method' => 'post']]);
        echo $form->field($appeal, 'childName')->input('text', ['readonly' => true])->label('Имя');
        echo $form->field($appeal, 'birthday')->input('date', ['class' => 'form-control', 'readonly' => true])->label('Дата рождения');
        echo $form->field($appeal, 'appeal_id')->hiddenInput(['value' => $appeal->id]);
        echo $form->field($pka, 'kindergarden_id')->dropDownList($items)->label('Детсад');
        echo Html::submitButton('Сохранить', ['class' => 'btnSave', 'name' => 'save', 'value' => 1]);
        echo Html::submitButton('Удалить', ['class' => 'btnDelete', 'name' => 'delete', 'value' => 2]);
        ActiveForm::end();
    }
    ?>

</div>

