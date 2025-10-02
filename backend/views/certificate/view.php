<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Certificate $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Certificates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="certificate-view">

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
            'title',
            [
                'attribute' => 'file',
                'format' => 'raw',
                'value' => function ($model) {
                    if (!$model->file) {
                        return null;
                    }

                    $url = $model->getFileUrl();
                    $ext = strtolower(pathinfo($model->file, PATHINFO_EXTENSION));

                    $preview = '';
                    if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
                        $preview = Html::img($url, ['style' => 'max-width:200px;display:block;margin-bottom:10px;']);
                    } elseif ($ext === 'pdf') {
                        $preview = Html::a('Preview PDF', $url, ['target' => '_blank', 'class' => 'btn btn-info']);
                    }

                    return $preview . Html::a('Download', $url, [
                        'class' => 'btn btn-success',
                        'download' => $model->file
                    ]);
                }
            ],
            [
                'attribute' => 'status',
                'value' => $model->status ? 'Active' : 'Inactive',
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>


</div>