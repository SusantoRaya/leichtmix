<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Shop $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="shop-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([
        1 => 'Active',
        0 => 'Inactive',
    ]) ?>

    <?= $form->field($model, 'sort')->textInput(['type' => 'number']) ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'buttonImageFile')->fileInput() ?>
            <?php if ($model->button_image): ?>
                <div class="mt-2">
                    <img src="<?= $model->getButtonImageUrl() ?>" alt="" style="max-height:60px;border:1px solid #ddd;padding:2px;border-radius:4px;">
                </div>
            <?php endif; ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'buttonImageAltFile')->fileInput() ?>
            <?php if ($model->button_image_alt): ?>
                <div class="mt-2">
                    <img src="<?= $model->getButtonImageAltUrl() ?>" alt="" style="max-height:60px;border:1px solid #ddd;padding:2px;border-radius:4px;">
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>