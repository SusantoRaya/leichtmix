<?php
$this->registerJs(
    <<<'JS'
    $( document ).ready(function() {
        const headerEl = document.querySelector("#product-header h2");
        const items = document.querySelectorAll(".list-group-item");
        const products = document.querySelectorAll(".product-item");
    
        items.forEach(item => {
            item.addEventListener("click", function () {
            // Reset active
            items.forEach(li => li.classList.remove("active"));
            this.classList.add("active");

            const filterValue = this.dataset.filter;
            const groupValue = this.dataset.group;
            const products = document.querySelectorAll(".product-item");

            products.forEach(p => {
                if (filterValue === "all") {
                    // Show only products in the same group
                    p.style.display = (p.dataset.group === groupValue) ? "block" : "none";
                } else {
                    // Show only matching filter
                    p.style.display = (p.dataset.category === filterValue) ? "block" : "none";
                }
            });

            // Update header if "all"
            if (this.dataset.title) {
                headerEl.textContent = this.dataset.title;
            }
            
            });
        });


        // ✅ Deep link handling
        // const urlParams = new URLSearchParams(window.location.search);
        // const categoryParam = urlParams.get("category"); // e.g. control-panel OR product-5

        const pathParts = window.location.pathname.split("/").filter(Boolean);
        // example: /product/control-panel → ["product","control-panel"]
        const categoryParam = pathParts.length > 1 ? pathParts[pathParts.length - 1] : null;

        if (categoryParam) {
            // First try product filter
            let target = document.querySelector(`.list-group-item[data-filter='${categoryParam}']`);
            
            if (!target) {
                // If not product, try group "All" under category
                target = document.querySelector(`.list-group-item[data-filter='all'][data-group='${categoryParam}']`);
            }

            if (target) {
                // Open accordion
                const collapseEl = target.closest(".accordion-collapse");
                if (collapseEl && !collapseEl.classList.contains("show")) {
                    const bsCollapse = new bootstrap.Collapse(collapseEl, { toggle: true });
                }

                // Trigger click to apply filter
                target.click();
            }
        } else {
            // Default: auto open first "All"
            const firstAll = document.querySelector(".list-group-item[data-filter='all']");
            if (firstAll) {
                firstAll.click();
            }
        }


    });
JS
);


$this->registerCss(
    <<<'CSS'
    /* Custom accordion arrow */
    .accordion-button::after {
        flex-shrink: 0;
        width: 1rem;
        height: 1rem;
        margin-left: auto;
        content: "";
        background-image: url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 16 16\'><path fill=\'red\' d=\'M8 12L2 4h12L8 12z\'/></svg>");
        background-repeat: no-repeat;
        background-size: 1rem;
        transition: transform 0.3s ease;
    }

    .accordion-button:not(.collapsed)::after {
        transform: rotate(180deg);
    }
    .accordion-button:not(.collapsed) {
        background-color: #dc3545; /* red */
        color: white;
    }

    /* Make li clickable */
    .list-group-item {
        cursor: pointer;
    }

    .list-group-item:hover {
        background-color: #f8f9fa;
    }

    .list-group-item.active {
        background-color: #dc3545; /* red */
        color: white;
        font-weight: bold;
    }
CSS
);
?>


<!-- Start Our ShopSide Area -->
<section class="htc__shop__sidebar bg__white ptb--120">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-3 order-lg-1 order-2 col-sm-12">
                <div class="htc__shop__left__sidebar">
                    <div class="accordion" id="filterAccordion">

                        <!-- Category -->

                        <?php foreach ($categories as $i => $category): ?>

                            <?php
                            $category_name = yii\helpers\Html::encode($category->name);
                            $category_slug = $category->slug;
                            $children = $category->children ?? [];
                            ?>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="<?= 'headingCategory-' . $i ?>">
                                    <a href="<?= yii\helpers\Url::to(['product/index', 'category_slug' => $category->slug]) ?>">

                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="<?= '#collapseCategory-' . $i ?>" aria-expanded="false" aria-controls="<?= 'collapseCategory-' . $i ?>">
                                            <?= $category_name ?>
                                        </button>
                                    </a>

                                </h2>
                                <div id="<?= 'collapseCategory-' . $i ?>" class="accordion-collapse collapse " aria-labelledby="<?= 'headingCategory-' . $i ?>">
                                    <div class="accordion-body p-0">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item d-none" data-filter="all" data-group="<?= $category_slug ?>" data-title="<?= $category_name ?>">All</li>

                                            <?php foreach ($category->products as $product): ?>
                                                <?php $product_name = yii\helpers\Html::encode($product->name) ?>
                                                <li class="list-group-item" data-filter="<?= 'product-' . $product->id ?>" data-group="<?= $category_slug ?>" data-title="<?= $product_name ?>">
                                                    <a href="<?= Yii::$app->urlManager->createUrl(['product/detail', 'category_slug' => $product->category->slug, 'product_slug' => $product->slug]) ?>">
                                                        <?= $product->name; ?>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>

                                        </ul>
                                    </div>
                                </div>
                            </div>


                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-9 order-lg-2 order-1 col-sm-12 col-xs-12 smt-30">
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                        <div id="product-header" class="mb-4">
                            <h2></h2>
                        </div>
                        <div class="producy__view__container">

                        </div>
                    </div>
                </div>
                <div class="tab-contet shop__grid__view__wrap">
                    <!-- Start Single View -->
                    <div role="tabpanel" id="grid-view" class="row single-grid-view tab-pane  active clearfix">

                        <?php foreach ($categories as $i => $category): ?>
                            <?php foreach ($category->products as $product): ?>
                                <!-- Start Single Product -->
                                <div class="col-md-4 col-lg-4 col-sm-12 product-item" data-category="<?= 'product-' . $product->id ?>" data-group="<?= $category->slug ?>">
                                    <div class="product">
                                        <div class="product__inner">
                                            <div class="pro__thumb">
                                                <a href="<?= Yii::$app->urlManager->createUrl(['product/detail', 'category_slug' => $product->category->slug, 'product_slug' => $product->slug]) ?>">
                                                    <img src="<?= Yii::getAlias('@web') ?>/images/product/1.png" alt="product images">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="product__details text-center">
                                            <h2><a href="<?= Yii::$app->urlManager->createUrl(['product/detail', 'category_slug' => $product->category->slug, 'product_slug' => $product->slug]) ?>"><?= $product->name; ?></a></h2>
                                            <div class="d-flex justify-content-center gap-2 mt-3">
                                                <a href="<?= Yii::$app->urlManager->createUrl(['product/detail', 'category_slug' => $product->category->slug, 'product_slug' => $product->slug]) ?>" class="btn btn-outline-danger px-4">Pelajari Selengkapnya</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Single Product -->
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </div>
                    <!-- End Single View -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Our ShopSide Area -->