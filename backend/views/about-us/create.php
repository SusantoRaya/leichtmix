<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\AboutUs $model */

$this->title = 'Create About Us';
$this->params['breadcrumbs'][] = ['label' => 'About uses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="about-us-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
