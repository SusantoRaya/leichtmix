<?php

use common\models\SocialMedia;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Social Media';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="social-media-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php //Html::a('Create Social Media', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'name',
            [
                'attribute' => 'icon',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->icon ? "<i class='{$model->icon}'></i> {$model->icon}" : null;
                },
            ],
            'url:url',
            [
                'attribute' => 'status',
                'value' => fn($model) => $model->status ? 'Active' : 'Inactive',
                'filter' => [1 => 'Active', 0 => 'Inactive'],
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}', // ✅ only show update
            ],
        ],
    ]); ?>



</div>