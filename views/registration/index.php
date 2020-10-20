<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
?>


<div class="container">
    <h1>Регистрация</h1>
    <?php
        $model->role = 1;
        $form = ActiveForm::begin(['options' => ['class' => 'form-group', 'method' => 'post', 'action' => ['web/parent/index']]]);
        echo $form->field($model, 'login')->label('Логин');
        echo $form->field($model, 'password')->input('password', ['class' => 'form-control'])->label('Пароль');
        echo $form->field($model, 'name')->label('ФИО');
        echo $form->field($model, 'role')->radioList([1 => "родитель" , 2 => 'работник']);
        echo Html::submitButton('Зарегестрироваться', ['class' => 'btnSuccess']);
        ActiveForm::end();
    ?>

</div>
