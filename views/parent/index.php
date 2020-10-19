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
        <?php
        $status = [1 => 'На рассмотрении', 2 => 'Принята', 3 => 'Отклонена', 4 => 'Нет мест'];
            foreach ($model as $key => $value){
                $n = $value->status;
                $test=serialize($value);
                echo "<tr>
                        <td>$value->id</td>
                        <td>$value->date</td>
                        <td>
                        
                        " . Html::a($value->childName . ', ' . $value->birthday, ['detail-cab', 'id' => $value->id]) . "
                        </td>
                        <td> $status[$n] </td>
                        <td>$appealsBefore[$key]</td>
                        <td></td>
                    </tr>";
            }
        ?>


    </table>
    <?php
        echo Html::a('Новая заявка', ['parent/appeal-new'], ['class' => 'pRefer']);
    ?>
</div>

