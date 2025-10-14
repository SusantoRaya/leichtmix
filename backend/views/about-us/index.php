<?php

use common\models\AboutUs;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'About uses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="about-us-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create About Us', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'title',
            [
                'attribute' => 'content',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->content;
                },
            ],
            'image',
            'status',
            //'created_at',
            //'updated_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, AboutUs $model, $key, $index, $column) {
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


</div>