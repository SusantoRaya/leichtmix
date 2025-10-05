<?php foreach ($category->products as $product): ?>

    <?php
    // Extract YouTube video ID
    preg_match('/(?:v=|\/)([0-9A-Za-z_-]{11})/', $product->video_url, $matches);
    $videoId = $matches[1] ?? null;
    $thumbnailUrl = $videoId ? "https://img.youtube.com/vi/{$videoId}/hqdefault.jpg" : null;
    $embedUrl = $videoId ? "https://www.youtube.com/embed/{$videoId}?autoplay=1" : null;

    // Unique modal ID for each product
    $modalId = "videoModal-" . $product->id;
    $iframeId = "videoFrame-" . $product->id;
    ?>


    <div class="col-md-4 col-lg-4 col-sm-12 product-item" data-category="<?= 'product-' . $product->id ?>" data-group="<?= 'group-' . $category->id ?>">
        <div class=" product">
            <?php if($product->video_url): ?>
            <div class="product__inner">
                <div class="pro__thumb">
                    <?php if ($thumbnailUrl): ?>
                        <img src="<?= $thumbnailUrl ?>" alt="Video preview"
                            class="img-fluid rounded mb-2"
                            style="cursor:pointer;"
                            data-bs-toggle="modal" data-bs-target="#<?= $modalId ?>">
                    <?php else: ?>
                        <div class="bg-dark text-white p-5 mb-2">Video Preview Not Available</div>
                    <?php endif; ?>
                    
                </div>
            </div>
            <div class="product__details text-center">
                <h2><a href="product-details.html"><?= yii\helpers\Html::encode($product->name) ?></a></h2>
                <div class="d-flex justify-content-center gap-2 mt-3">
                    
                    <!-- Button -->
                    <?php if ($embedUrl): ?>
                        <button class="btn btn-outline-secondary px-4"
                            data-bs-toggle="modal"
                            data-bs-target="#videoModal"
                            data-video="<?= $embedUrl ?>">
                            Lihat Video
                        </button>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>

<?php endforeach; ?>