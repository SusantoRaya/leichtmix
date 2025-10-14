<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\ProductPreparation $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="product-preparation-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>


    <?= $form->field($model, 'product_id')->dropDownList($products, ['prompt' => 'Select a Product...']) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'imageFile')->fileInput() ?>

    <?php if (!$model->isNewRecord && $model->image): ?>
        <div class="mb-3">
            <img src="<?= Yii::getAlias('@web/uploads/product/preparation/' . $model->image) ?>"
                alt="Preparation Image"
                style="max-width:200px; border-radius:8px;">
        </div>
    <?php endif; ?>


    <?= $form->field($model, 'sort_order')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>