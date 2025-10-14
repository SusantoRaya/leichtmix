<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
?>

<div class="certificate-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>


     <?= $form->field($model, 'subtitle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fileUpload')->fileInput() ?>

    <?php if (!$model->isNewRecord && $model->file): ?>
        <p>Current File:
            <a href="<?= $model->getFileUrl() ?>" target="_blank">
                <?= Html::encode($model->file) ?>
            </a>
        </p>
    <?php endif; ?>

    <?= $form->field($model, 'status')->dropDownList([1 => 'Active', 0 => 'Inactive']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>