<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\ProductPreparation $model */

$this->title = 'Update Product Preparation: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Product Preparations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-preparation-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'products' => $products
    ]) ?>

</div>
