<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\Product $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

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
            'slug',
            [
                'attribute' => 'price',
                'value' => Yii::$app->formatter->asCurrency($model->price, 'IDR'),
            ],
            'description:ntext',   // <--- added here
            [
                'attribute' => 'category_id',
                'value' => $model->category ? $model->category->name : '-',
            ],
            [
                'attribute' => 'status',
                'value' => $model->status == 1 ? 'Active' : 'Inactive',
            ],
            [
                'label' => 'Shop Links',
                'format' => 'raw',
                'value' => function ($model) {
                    $links = [];
                    foreach ($model->productShops as $ps) {
                        $links[] = $ps->shop->name . ': <a href="' . $ps->shop_link . '" target="_blank">' . $ps->shop_link . '</a>';
                    }
                    return implode('<br>', $links);
                }
            ],
            [
                'attribute' => 'image',
                'format' => 'html',
                'value' => function ($model) {
                    return $model->image
                        ? Html::img($model->getImageUrl(), ['style' => 'max-width:200px;'])
                        : '(no image)';
                },
            ],

            [
                'attribute' => 'guide_file',
                'format' => 'raw',
                'value' => $model->guide_file
                    ? \yii\helpers\Html::a('Download Guide', $model->getGuideUrl(), ['target' => '_blank'])
                    : '-',
            ],
            [
                'attribute' => 'video_url',
                'format' => 'raw',
                'value' => $model->video_url
                    ? \yii\helpers\Html::a('Watch Video', $model->video_url, ['target' => '_blank'])
                    : '-',
            ],

        ],
    ]) ?>


    <h3>Related Products</h3>
    <?php if ($model->relatedProductsFinal): ?>
        <div class="row">
            <?php foreach ($model->relatedProductsFinal as $related): ?>
                <div class="col-md-3 col-sm-4 col-6 mb-4">
                    <div class="card h-100 text-center shadow-sm">
                        <div class="card-body">
                            <?= Html::a(
                                Html::img(
                                    $related->getImageUrl(),
                                    ['class' => 'img-fluid mb-2', 'style' => 'max-height:120px;']
                                ),
                                ['view', 'id' => $related->id]
                            ) ?>
                            <h6 class="card-title">
                                <?= Html::a(Html::encode($related->name), ['view', 'id' => $related->id]) ?>
                            </h6>
                            <p class="text-muted mb-0">
                                <?= Yii::$app->formatter->asCurrency($related->price, 'IDR') ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p><em>No related products assigned.</em></p>
    <?php endif; ?>

</div>