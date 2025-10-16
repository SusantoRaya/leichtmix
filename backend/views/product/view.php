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


$reorderUrl = Url::to(['product-preparation/reorder']);
$this->registerJsFile('https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js', [
    'depends' => [\yii\web\JqueryAsset::class], // optional dependency so script loads after jQuery if you need jQuery elsewhere
]);


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




    <h3 class="mt-5 mb-3">Preparation Steps</h3>

    <p>
        <?= \yii\helpers\Html::a(
            '<i class="fa fa-plus"></i> Add Preparation',
            ['product-preparation/create', 'product_id' => $model->id],
            ['class' => 'btn btn-success']
        ) ?>
    </p>

    <?= \yii\grid\GridView::widget([
        'dataProvider' => $preparationDataProvider,
        'tableOptions' => ['class' => 'table table-bordered table-hover sortable-grid'],
        'rowOptions' => function ($model) {
            return ['data-id' => $model->id];
        },
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'sort_order',
                'label' => '-',
                'format' => 'raw',
                'value' => function () {
                    return '<span class="handle" style="cursor: grab;"><i class="fa fa-bars"></i></span>';
                },
                'contentOptions' => ['class' => 'sort-handle']
            ],
            [
                'attribute' => 'title',
                'format' => 'text',
                'contentOptions' => ['style' => 'width:30%;'],
            ],
            [
                'attribute' => 'image',
                'format' => 'html',
                'value' => function ($model) {
                    return $model->image
                        ? Html::img($model->getImageUrl(), ['width' => '100'])
                        : null;
                }
            ],
            // [
            //     'attribute' => 'sort_order',
            //     'label' => 'Sort',
            //     'contentOptions' => ['style' => 'width:100px;text-align:center;'],
            // ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return \yii\helpers\Html::a(
                            '<i class="fa fa-edit"></i>',
                            ['product-preparation/update', 'id' => $model->id],
                            ['class' => 'btn btn-sm btn-primary']
                        );
                    },
                    'delete' => function ($url, $model) {
                        return \yii\helpers\Html::a(
                            '<i class="fa fa-trash"></i>',
                            ['product-preparation/delete', 'id' => $model->id],
                            [
                                'class' => 'btn btn-sm btn-danger',
                                'data' => [
                                    'confirm' => 'Are you sure you want to delete this preparation?',
                                    'method' => 'post',
                                ],
                            ]
                        );
                    },
                ],
                'contentOptions' => ['style' => 'width:150px; text-align:center;'],
            ],
        ],
    ]) ?>



</div>


<?php
$js = <<<JS
function initSortableJS(){
    var el = document.querySelector(".sortable-grid tbody");
    if(!el) return;

    if(el._sortable) {
        // already initialized
        return;
    }

    el._sortable = Sortable.create(el, {
        handle: ".sort-handle",
        animation: 150,
        onEnd: function (evt) {
            var order = [];
            el.querySelectorAll("tr").forEach(function(row){
                order.push(row.getAttribute("data-id"));
            });

            // send using fetch; include CSRF token
            var csrfParam = yii.getCsrfParam();
            var csrfToken = yii.getCsrfToken();
            var formData = new FormData();
            order.forEach(function(id){ formData.append('order[]', id); }); // send as order[] or as order=JSON
            formData.append(csrfParam, csrfToken);

            fetch("{$reorderUrl}", {
                method: 'POST',
                body: formData,
                credentials: 'same-origin',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            }).then(function(resp){ return resp.json(); })
              .then(function(data){
                if(!data.success){
                    alert("Failed to save order");
                }
              }).catch(function(){
                alert("Error while saving order");
              });
        }
    });
}

// init on load
initSortableJS();

// re-init after PJAX
$(document).on('pjax:end', function(){ initSortableJS(); });
JS;
$this->registerJs($js);
?>