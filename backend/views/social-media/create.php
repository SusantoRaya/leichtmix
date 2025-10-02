<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\SocialMedia $model */

$this->title = 'Create Social Media';
$this->params['breadcrumbs'][] = ['label' => 'Social Media', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="social-media-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
