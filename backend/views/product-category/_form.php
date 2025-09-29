<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use common\models\ProductCategory;

/** @var yii\web\View $this */
/** @var common\models\ProductCategory $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="product-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent_id')->dropDownList(
        ProductCategory::find()
            ->select(['name', 'id'])
            ->indexBy('id')
            ->column(),
        ['prompt' => 'No Parent']   // default empty option
    ) ?>

    <?= $form->field($model, 'status')->dropDownList([
        1 => 'Active',
        0 => 'Inactive',
    ]) ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>