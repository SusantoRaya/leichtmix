<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var $model app\models\Product */

$this->registerCss(
    <<<'CSS'
    .text-justify{
        text-align: justify;
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

                <p class="fs-4 text-danger mb-3">
                    <?= Yii::$app->formatter->asCurrency($model->price, 'IDR') ?>
                </p>

                <p class="mb-4 text-justify">
                    <?= nl2br(Html::encode($model->description)) ?>
                </p>



                <!-- Guide buttons -->
                <?php if ($model->guide_file): ?>
                    <div class="mb-3">
                        <a href="<?= $model->getGuideUrl() ?>"
                            target="_blank"
                            class="btn btn-outline-primary me-2">
                            👀 Preview Guide
                        </a>
                        <a href="<?= $model->getGuideUrl() ?>"
                            download
                            class="btn btn-success">
                            ⬇️ Download Guide
                        </a>
                    </div>
                <?php endif; ?>

                <!-- Video button -->
                <?php if ($model->video_url): ?>
                    <?php
                    // Extract YouTube ID
                    preg_match('/(?:v=|\/)([0-9A-Za-z_-]{11})/', $model->video_url, $matches);
                    $videoId = $matches[1] ?? null;
                    $embedUrl = $videoId ? "https://www.youtube.com/embed/{$videoId}?autoplay=1" : null;
                    ?>
                    <?php if ($embedUrl): ?>
                        <button class="btn btn-danger"
                            data-bs-toggle="modal"
                            data-bs-target="#videoModal"
                            data-video="<?= $embedUrl ?>">
                            🎥 Lihat Video
                        </button>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <h5 class="fw-bold mb-3 text-center">
                    Tersedia di Toko Online Kesayangan Anda:
                </h5>

                <div class="d-flex gap-3 mb-4 justify-content-center">
                    <?php foreach ($model->productShops as $productShop): ?>
                        <?php if ($productShop->shop && $productShop->shop_link): ?>
                            <a href="<?= Html::encode($productShop->shop_link) ?>"
                                target="_blank"
                                class="d-inline-block">
                                <img src="<?= $productShop->shop->getButtonImageAltUrl() ?>"
                                    alt="<?= Html::encode($productShop->shop->name) ?>"
                                    style="height:50px;">
                            </a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>





    </div>

    <div class="container related-products-section my-5">
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
                    <?php foreach ($relatedProducts as $product): ?>
                        <div class="col-md-6 mb-4">
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

                                    <p class="fs-4 text-danger mb-3">
                                        <?= Yii::$app->formatter->asCurrency($product->price, 'IDR') ?>
                                    </p>

                                    <p class="mb-4 text-justify">
                                        <?= nl2br(Html::encode($product->description)) ?>
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