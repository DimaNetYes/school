<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
    $this->registerCssFile('@web/css/parent.css');

if (Yii::$app->session->hasFlash('success')) {
    echo "<div class='alert alert-success'>";
    echo Yii::$app->session->getFlash('success');
    echo "</div>";
}

?>

<div class="container">
    <h1>Кабинет родителей</h1>
    <h3>Заявки</h3>
    <table>
        <tr>
            <td>#</td>
            <td>Дата подачи</td>
            <td>Ребенок</td>
            <td>Статус</td>
            <td>Заявок впереди</td>
            <td>Мест в саду</td>
        </tr>
        <tr>
            <td>фвыа</td>
            <td>вфыафвы</td>
            <td>авфыа</td>
            <td>фвыа</td>
            <td>фвыа</td>
            <td>фвыа</td>
        </tr>
    </table>
    <?php
        echo Html::a('Новая заявка', ['parent/appeal-new'], ['class' => 'pRefer']);
        print_r($model);
    ?>
</div>

