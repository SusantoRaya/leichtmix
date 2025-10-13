<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var $model app\models\Product */

$this->registerCss(
    <<<'CSS'
    .text-justify{
        text-align: justify;
    }

    .preparation-section {
    background-color: #fff;
    }
    .prep-step img {
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    .prep-caption {
    max-width: 100%;
    margin: 0 auto;
    }
    .step-number {
    font-size: 2rem;
    font-weight: 700;
    color: #bcbcbc;
    line-height: 1;
    }
    .prep-step p {
        font-size: 0.95rem;
        color: #555;
    }
    @media (max-width: 768px) {
        .step-number {
            font-size: 1.5rem;
        }
    }

    CSS
);



?>
<section class="htc__shop__sidebar bg__white pb--120">
    <div class="container my-5">
        <h1 class="text-center">PRODUK</h1>

        <hr style="border: 1px solid #000;">

        <div class="row align-items-start pt-5">

            <!-- Left: Image -->
            <div class="col-md-4 text-center mb-4 mb-md-0">
                <img src="<?= $model->getImageUrl() ?>"
                    alt="<?= Html::encode($model->name) ?>"
                    class="img-fluid rounded shadow">
            </div>

            <!-- Right: Details -->
            <div class="col-md-8">
                <h2 class="fw-bold text-danger mb-3">
                    <u><?= Html::encode($model->name) ?></u>
                </h2>


                <p class="mb-4 text-justify">
                    <?= $model->description ?? '' ?>
                </p>

            </div>
        </div>

    </div>


    <?php if (!empty($model->preparations)): ?>


        <div class="container preparation-section my-5">

            <hr style="border: 1px solid #000;">

            <!-- Section Title -->
            <div class="row mb-5">
                <div class="col-12">
                    <div class="section-title-container text-center">
                        <h1>PERSIAPAN</h1>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <div class="row justify-content-center">
                    <?php foreach ($model->preparations as $index => $prep): ?>
                        <div class="col-md-4 mb-4">
                            <div class="prep-step">
                                <?php if ($prep->image): ?>
                                    <img src="<?= $prep->getImageUrl() ?>"
                                        class="card-img-top img-fluid"
                                        alt="<?= Html::encode($prep->title) ?>">
                                <?php endif; ?>
                                <div class="prep-caption d-flex align-items-start justify-content-center">
                                    <span class="step-number me-2"><?= $index + 1 ?></span>
                                    <p class="mb-0 text-start">
                                        <?= $prep->title ?>
                                    </p>
                                </div>
                            </div>
                        </div>


                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>


    <div class="container related-products-section my-5">
        <hr style="border: 1px solid #000;">

        <!-- Section Title -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="section-title-container text-center">
                    <h1>PRODUK LAINNYA</h1>
                </div>
            </div>
        </div>

        <!-- Related Products Grid -->
        <?php if ($relatedProducts): ?>
            <div class="related-products mt-10">
                <div class="row">
                    <?php foreach ($relatedProducts as $index => $product): ?>
                        <div class="col-md-6 mb-4 <?= $index % 2 == 0 ? 'border-end' : '' ?>">
                            <div class="row align-items-start pt-5">
                                <!-- Left: Image -->
                                <div class="col-md-4 text-center mb-4 mb-md-0">
                                    <a href="<?= Yii::$app->urlManager->createUrl(['product/detail', 'category_slug' => $product->category->slug, 'product_slug' => $product->slug]) ?>">
                                        <img src="<?= $product->getImageUrl() ?>"
                                            alt="<?= Html::encode($model->name) ?>"
                                            class="img-fluid rounded shadow">
                                    </a>
                                </div>

                                <!-- Right: Details -->
                                <div class="col-md-8">
                                    <h2 class="fw-bold text-danger mb-2">
                                        <a href="<?= Yii::$app->urlManager->createUrl(['product/detail', 'category_slug' => $product->category->slug, 'product_slug' => $product->slug]) ?>">
                                            <u><?= Html::encode($product->name) ?></u>
                                        </a>
                                    </h2>


                                    <p class="mb-4 text-justify">
                                        <?= mb_strimwidth($product->description ?? '', 0, 300, '...'); ?>
                                    </p>

                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>

</section>



<!-- Shared Video Modal -->
<div class="modal fade" id="videoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="ratio ratio-16x9">
                    <iframe id="videoFrame"
                        src=""
                        title="Installation Video"
                        allow="autoplay; encrypted-media"
                        allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$this->registerJs("
  var videoModal = document.getElementById('videoModal');
  var videoFrame = document.getElementById('videoFrame');

  videoModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var videoUrl = button.getAttribute('data-video');
    videoFrame.src = videoUrl;
  });

  videoModal.addEventListener('hidden.bs.modal', function () {
    videoFrame.src = '';
  });
");
?>