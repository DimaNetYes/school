<?php
use app\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);

?>
<?php
    $this->beginPage();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody();?>

    <?= Breadcrumbs::widget([
            'homeLink' => [
                    'label' => 'Главная', 'url' => 'http://localhost/basic/web/parent/index',
                    'title' => 'Главная страница',
                ],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],

    ]);
    ?>


<?= $content ?>

<?php $this->endBody(); ?>
</body>
</html>
<?php
    $this->endPage();
?>
