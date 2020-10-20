<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
?>
<?php

?>

<div class="container">
    <h1>Кабинет Работника МОН</h1>
    <p>Новых заявок: <b><?=  $countAppeals ?></b></p>

    <?=  Html::a('Начать рассмотрение заявок', ['detail-cab'], ['class' => 'workA']) ?>
</div>








