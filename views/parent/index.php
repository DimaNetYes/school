<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->registerCssFile('@web/css/parent.css');

if (Yii::$app->session->hasFlash('success')) {
    echo "<div class='alert alert-success'>";
    echo Yii::$app->session->getFlash('success');
    echo "</div>";
}
$this->params['breadcrumbs'][] = '';

?>

<div class="container">
    <h1>Кабинет родителей</h1>
    <h3>Заявки</h3>
    <?= Html::a('Grid', 'http://localhost/basic/web/appeal-grid/index') ?>
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
        foreach ($model as $key => $value):
            $test=serialize($value);
?>

           <tr>
                <td><?= $value->id ?></td>
                <td><?=$value->date?></td>
                <td>
                <?= Html::a($value->childName . ', ' . $value->birthday, ['detail-cab', 'id' => $value->id]) ?>
                </td>
                <td><?= $value->statusCode[$value->status]?></td>

                <?php if($value->status == 1): ?>
                    <td><?=$appealsBefore[$key] ?></td>
                    <td><?=$capacity[$key] ?></td>
               <?php else: ?>
                    <td></td>
                    <td></td>
                <?php endif; ?>
           </tr>

<?php endforeach; ?>


    </table>
    <?php
        echo Html::a('Новая заявка', ['parent/appeal-new'], ['class' => 'pRefer']);
    ?>
</div>

