<?php foreach ($category->products as $product): ?>
    <div class="col-md-4 col-lg-4 col-sm-12 product-item" data-category="<?= 'product-' . $product->id ?>" data-group="<?= 'group-' . $category->id ?>">
        <div class="product">
            <div class="product__inner">
                <div class="pro__thumb">
                    <a href="#">
                        <?php if ($product->image): ?>
                            <img src="<?= $product->getImageUrl() ?>"
                                alt="<?= yii\helpers\Html::encode($product->name) ?>">
                        <?php endif; ?>
                    </a>
                </div>
            </div>
            <div class="product__details text-center">
                <h2><a href="product-details.html"><?= yii\helpers\Html::encode($product->name) ?></a></h2>
                <div class="d-flex justify-content-center gap-2 mt-3">

                    <?php if ($product->guide_file): ?>
                        <!-- Preview button -->
                        <a href="<?= $product->getGuideUrl() ?>"
                            class="btn btn-outline-secondary px-4"
                            target="_blank">
                            Preview
                        </a>

                        <!-- Download button -->
                        <a href="<?= $product->getGuideUrl() ?>"
                            class="btn btn-danger px-4"
                            download>
                            Download
                        </a>

                    <?php else: ?>
                        <p>No guide available for this product.</p>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>