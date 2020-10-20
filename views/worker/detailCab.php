<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
?>

<div class="container">
    <h1>Кабинет работница МОН</h1>
    <h3>
        Заявка
        <?php
            echo '#' . $appeal->number . ' от ' . str_replace("-", ".", $appeal->date);
        ?>
    </h3>

    <?php
        $items = [];
        foreach ($kindergarden as $key => $val) {
            $items[$val->id] = $val->name;
        }

        $form = ActiveForm::begin((['options' => ['class' => 'form-group', 'method' => 'post']]));
        echo $form->field($appeal, 'childName')->input('text')->label('Имя');
        echo $form->field($appeal, 'birthday')->input('date', ['class' => 'form-control'])->label('Дата рождения');
        echo $form->field($appeal, 'appeal_id')->hiddenInput(['value' => $appeal->id]);
        echo $form->field($pka, 'kindergarden_id')->dropDownList($items)->label('Детсад');
        echo Html::submitButton('Принять', ['class' => 'btnSave', 'name' => 'save', 'value' => 1]);
        echo Html::submitButton('Отклонить', ['class' => 'btnDelete', 'name' => 'cancel', 'value' => 2]);
        echo Html::submitButton('Выйти', ['class' => 'btnDelete', 'name' => 'exit', 'value' => 3]);
        ActiveForm::end();
    ?>
</div>