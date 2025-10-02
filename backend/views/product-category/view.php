<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var common\models\ProductCategory $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Product Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-category-view">

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
            'parent_id',
            'status',
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
                'attribute' => 'created_at',
                'format' => ['datetime'],
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['datetime'],
            ],

        ],
    ]) ?>

</div>


<div class="product-faq-management" style="margin-top: 40px;">
    <h3><?= Html::encode('Product FAQs') ?></h3>

    <p>
        <?= Html::a('Create FAQ', ['/faq/create', 'product_category_id' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $faqDataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'question',
            'answer:ntext',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return $model->status ? 'Active' : 'Inactive';
                },
            ],
            'sort_order',
            [
                'class' => 'yii\grid\ActionColumn',
                'controller' => 'faq', // Point actions to FaqController
                'template' => '{update} {delete}', // We don't need a separate 'view' here
                'urlCreator' => function ($action, $faqModel, $key, $index) {
                    // The $faqModel here is the FAQ item for the current row.
                    // We can get the product_id directly from it.
                    return Url::to(['/faq/' . $action, 'id' => $faqModel->id]);
                }
            ],
        ],
    ]); ?>
</div>