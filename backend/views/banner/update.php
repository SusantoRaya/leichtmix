<h1>Update Banner: <?= $model->title ?></h1>



<?= $this->render('_form', [
    'model' => $model,
    'disabledPages' => $disabledPages
    // 'imageModel' => $imageModel,
]) ?>

<hr>