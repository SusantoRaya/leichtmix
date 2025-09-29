<?php

use yii\grid\GridView;
use yii\helpers\Html;
use common\models\Banner;

/* @var $searchModel backend\models\BannerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

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
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
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
            'sort_order',
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
    ]); ?>
</div>