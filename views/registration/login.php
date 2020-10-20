<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
?>

<?php
//    print_r($model);
//    $model->role = 1;
    $form = ActiveForm::begin(['options' => ['class' => 'form-group', 'method' => 'post', 'action' => ['']]]);
    echo $form->field($model, 'login')->label('Логин');
    echo $form->field($model, 'password')->input('password', ['class' => 'form-control'])->label('Пароль');
    echo Html::submitButton('Войти', ['class' => 'btnSuccess']);
    ActiveForm::end();
?>



