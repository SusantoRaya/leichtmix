<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Shop;
use dosamigos\ckeditor\CKEditor;

/** @var yii\web\View $this */
/** @var common\models\Product $model */
/** @var yii\widgets\ActiveForm $form */


$this->registerJs(
    <<<JS
function formatNumber(num) {
    return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

const priceInput = document.getElementById('price-input');
if (priceInput) {
    priceInput.addEventListener('input', function(e) {
        let value = this.value.replace(/,/g, ''); // remove commas
        if (!isNaN(value) && value.length > 0) {
            this.value = formatNumber(value);
        } else {
            this.value = '';
        }
    });
}
JS

);
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>


    <?= $form->field($model, 'category_id')->dropDownList(
        \common\models\ProductCategory::find()
            ->select(['name', 'id'])
            ->indexBy('id')
            ->column(),
        ['prompt' => 'Select Category']
    ) ?>

    <?= $form->field($model, 'relatedProductIds')->widget(Select2::class, [
        'data' => ArrayHelper::map(\common\models\Product::find()->where(['!=', 'id', $model->id])->all(), 'id', 'name'),
        'options' => ['placeholder' => 'Select related products...', 'multiple' => true],
        'pluginOptions' => ['allowClear' => true],
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->widget(\dosamigos\ckeditor\CKEditor::class, [
        'options' => ['rows' => 6],
        'preset' => 'full', // this already includes many tools
        'clientOptions' => [
            'extraPlugins' => 'uploadimage,image2,colorbutton,colordialog',
            'filebrowserUploadUrl' => Yii::$app->urlManager->createUrl(['product/upload-image']),
            'filebrowserUploadMethod' => 'form',
            'toolbar' => [
                ['name' => 'clipboard', 'items' => ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']],
                ['name' => 'editing', 'items' => ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt']],
                ['name' => 'basicstyles', 'items' => ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', 'RemoveFormat']],
                ['name' => 'colors', 'items' => ['TextColor', 'BGColor']], // 👈 color buttons here
                ['name' => 'paragraph', 'items' => ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote']],
                ['name' => 'insert', 'items' => ['Image', 'Table', 'HorizontalRule', 'SpecialChar']],
                ['name' => 'styles', 'items' => ['Styles', 'Format', 'Font', 'FontSize']],
            ],
        ]
    ]) ?>

    <?= $form->field($model, 'price')->textInput([
        'id' => 'price-input',
        'class' => 'form-control',
    ]) ?>

    <?php
    $shops = Shop::find()->where(['status' => 1])->all();

    foreach ($shops as $shop) {
        $existing = null;
        foreach ($model->productShops as $ps) {
            if ($ps->shop_id == $shop->id) {
                $existing = $ps;
                break;
            }
        }
        $value = $existing ? $existing->shop_link : '';
        echo $form->field($model, "shopLinks[{$shop->id}]")->textInput([
            'value' => $value,
            'placeholder' => "Enter link for {$shop->name}",
        ])->label($shop->name);
    }
    ?>
    <?= $form->field($model, 'status')->dropDownList([
        1 => 'Active',
        0 => 'Inactive',
    ]) ?>

    <?= $form->field($model, 'imageFile')->fileInput() ?>

    <?php if ($model->image): ?>
        <div class="m-5">
            <img src="<?= $model->getImageUrl() ?>" style="max-width:150px;">
        </div>
    <?php endif; ?>


    <?= $form->field($model, 'guideFileUpload')->fileInput() ?>

    <?= $form->field($model, 'video_url')->textInput(['placeholder' => 'YouTube or Vimeo link']) ?>




    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>