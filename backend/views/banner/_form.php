<?php

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;


$options = [];
foreach ($disabledPages as $page) {
    $options[$page] = ['disabled' => true];
}

?>


<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'enableClientValidation' => true,]]); ?>


<?= $form->field($model, 'title')->textInput() ?>
<?= $form->field($model, 'page')->dropDownList(
    $model::PAGES,
    [
        'class' => 'form-select',
        'options' => $options,
    ]
) ?>
<?= $form->field($model, 'link')->textInput() ?>
<?= $form->field($model, 'sort_order')->textInput() ?>
<?= $form->field($model, 'status')->dropDownList([1 => 'Active', 0 => 'Inactive']) ?>


<?= $form->field($model, 'imageFile')->fileInput()->label('image (Desktop 1920x1080)') ?>

<?php if (!$model->isNewRecord && $model->image): ?>
    <p>Current Image:</p>
    <div class="row">
        <div class="col-md-3 text-center">
            <img src="<?= $model->getImageUrl() ?>" style="height:150px">

        </div>

    </div>
<?php endif; ?>
<hr>
<?= $form->field($model, 'imageFile_t')->fileInput()->label('image (Tablet 800x1280)') ?>

<?php if (!$model->isNewRecord && $model->image_t): ?>
    <p>Current Image:</p>
    <div class="row">
        <div class="col-md-3 text-center">
            <img src="<?= $model->getImageUrl_t() ?>" style="height:150px">

        </div>

    </div>
<?php endif; ?>

<hr>
<?= $form->field($model, 'imageFile_m')->fileInput()->label('image (Mobile  720x1280)') ?>

<?php if (!$model->isNewRecord && $model->image_m): ?>
    <p>Current Image:</p>
    <div class="row">
        <div class="col-md-3 text-center">
            <img src="<?= $model->getImageUrl_m() ?>" style="height:150px">

        </div>

    </div>
<?php endif; ?>


<?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>


<?php ActiveForm::end(); ?>