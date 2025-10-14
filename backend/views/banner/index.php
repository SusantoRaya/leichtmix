<?php

use yii\grid\GridView;
use yii\helpers\Html;
use common\models\Banner;
use yii\helpers\Url;

/* @var $searchModel backend\models\BannerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$reorderUrl = Url::to(['reorder']);
$this->registerJsFile('https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js', [
    'depends' => [\yii\web\JqueryAsset::class], // optional dependency so script loads after jQuery if you need jQuery elsewhere
]);


$this->title = 'Banners';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="banner-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Banner', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
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
            'title',
            [
                'attribute' => 'page',
                'value' => function ($model) {
                    return Banner::PAGES[$model->page];
                },
                'filter' => Banner::PAGES,
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
            'link',
            
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return $model->status == 1 ? 'Active' : 'Inactive';
                },
                'filter' => [1 => 'Active', 0 => 'Inactive'],
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}', // only update & delete
            ],
        ],
        'pager' => [
            'class' => \yii\bootstrap5\LinkPager::class,
            'options' => ['class' => 'pagination justify-content-center'], // center the pagination
            'linkContainerOptions' => ['class' => 'page-item'],
            'linkOptions' => ['class' => 'page-link'],
        ],
    ]); ?>
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