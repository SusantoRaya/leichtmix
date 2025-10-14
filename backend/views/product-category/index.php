<?php

use common\models\ProductCategory;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap5\LinkPager;

/** @var yii\web\View $this */
/** @var backend\models\ProductCategorySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Product Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Product Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],
            // 'id',
            'name',
            [
                'attribute' => 'slug',
                'filter' => false,
            ],
            [
                'attribute' => 'parent_id',
                'value' => function ($model) {
                    return $model->parent ? $model->parent->name : '-';
                },
                'filter' => \common\models\ProductCategory::find()
                    ->select(['name', 'id'])
                    ->indexBy('id')
                    ->column(),
            ],
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return $model->status == 1 ? 'Active' : 'Inactive';
                },
                'filter' => [
                    1 => 'Active',
                    0 => 'Inactive',
                ],
            ],
            // [
            //     'attribute' => 'created_at',
            //     'format' => ['datetime'],
            // ],
            // [
            //     'attribute' => 'updated_at',
            //     'format' => ['datetime'],
            // ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, ProductCategory $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],

        'pager' => [
            'class' => \yii\bootstrap5\LinkPager::class,
            'options' => ['class' => 'pagination justify-content-center'], // center the pagination
            'linkContainerOptions' => ['class' => 'page-item'],
            'linkOptions' => ['class' => 'page-link'],
        ],

    ]); ?>

    <?php Pjax::end(); ?>

</div>