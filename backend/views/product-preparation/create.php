<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\ProductPreparation $model */

$this->title = 'Create Product Preparation';
$this->params['breadcrumbs'][] = ['label' => 'Product Preparations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-preparation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'products' => $products
    ]) ?>

</div>
