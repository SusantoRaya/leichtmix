<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Shop $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Shops', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="shop-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'url:url',
            'status',
            'sort',
            [
                'attribute' => 'button_image',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->button_image
                        ? Html::img($model->getButtonImageUrl(), [
                            'style' => 'max-height:60px;border:1px solid #ddd;padding:2px;border-radius:4px;'
                        ])
                        : null;
                },
            ],
            [
                'attribute' => 'button_image_alt',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->button_image_alt
                        ? Html::img($model->getButtonImageAltUrl(), [
                            'style' => 'max-height:60px;border:1px solid #ddd;padding:2px;border-radius:4px;'
                        ])
                        : null;
                },
            ],
            'created_at:date',
            'updated_at:date',
        ],
    ]) ?>

</div>
