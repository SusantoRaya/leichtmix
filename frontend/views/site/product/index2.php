<?php

use yii\helpers\Html;

$this->title = 'Product - Leichtmix Premium Mortar - Bersama Membangun Tanah Air';
$this->registerMetaTag(['name' => 'description', 'content' =>'' ]);

$this->registerJs(
    <<<'JS'
$(document).ready(function () {
    const headerEl = document.querySelector("#product-header h2");
    const items = document.querySelectorAll(".list-group-item");
    const products = document.querySelectorAll(".product-item");
    const subcats = document.querySelectorAll(".subcat-item");

    // ✅ Helper: toggle show/hide
    function showElement(el) {
        el.classList.remove("d-none");
        el.classList.add("d-block");
    }
    function hideElement(el) {
        el.classList.remove("d-block");
        el.classList.add("d-none");
    }

    // ✅ Helper: apply filter
    function applyFilter(filterValue, groupValue, parentgroupValue, title) {
        // Hide all subcats first
        subcats.forEach(hideElement);

        products.forEach(p => {
            let show = false;

            if (filterValue === "all") {
                show = (p.dataset.group === groupValue);
            } else if (filterValue === "all-category") {
                if (parentgroupValue && p.dataset.parentgroup === parentgroupValue) {
                    // show related subcats
                    document.querySelectorAll(`.subcat-item[data-parentgroup='${parentgroupValue}']`).forEach(showElement);
                }
            } else if (filterValue.startsWith("category-")) {
                show = (p.dataset.group === groupValue);
            } else {
                show = (p.dataset.filter === filterValue);
            }

            if (show) showElement(p);
            else hideElement(p);
        });

        // Update header
        if (title) headerEl.textContent = title;
    }

    // ✅ Attach event listeners
    items.forEach(item => {
        item.addEventListener("click", function () {
            items.forEach(li => li.classList.remove("active"));
            this.classList.add("active");

            const { filter, group, parentgroup, title } = this.dataset;
            applyFilter(filter, group, parentgroup, title);
        });
    });

    // ✅ Deep link handler
    const pathParts = window.location.pathname.split("/").filter(Boolean);
    const categoryParam = pathParts.length > 1 ? pathParts[pathParts.length - 1] : null;

    function openAndClick(target) {
        if (!target) return false;
        const collapseEl = target.closest(".accordion-collapse");
        if (collapseEl && !collapseEl.classList.contains("show")) {
            new bootstrap.Collapse(collapseEl, { toggle: true });
        }
        target.click();
        return true;
    }

    if (categoryParam) {
        const target =
            document.querySelector(`.list-group-item[data-filter='all'][data-group='${categoryParam}']`) ||
            document.querySelector(`.list-group-item[data-filter='all-category'][data-parentgroup='${categoryParam}']`) ||
            document.querySelector(`.list-group-item[data-group='${categoryParam}']`);

        if (!openAndClick(target)) {
            // fallback → open first all
            const firstAll = document.querySelector(".list-group-item[data-filter='all']");
            if (firstAll) firstAll.click();
        }
    } else {
        // Default open first all
        const firstAll = document.querySelector(".list-group-item[data-filter='all']");
        if (firstAll) firstAll.click();
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
        padding-left: 40px;
    }

    .list-group-item:hover {
        background-color: #f8f9fa;
    }

    .list-group-item.active {
        background-color: #dc3545; /* red */
        color: white;
        font-weight: bold;
    }

    .accordion-item {
        border: none;
        border-bottom: 1px solid #ddd;   /* divider line between items */
    }

CSS
);
?>


<!-- Start Our ShopSide Area -->
<section class="htc__shop__sidebar bg__white ptb--70">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-3 order-lg-1 order-1 col-sm-12 border-end">
                <div class="htc__shop__left__sidebar pb-5">
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

                                            <?php if ($category->children): ?>
                                                <!-- Level 2: Subcategories -->
                                                <li class="list-group-item d-none"
                                                    data-filter="all-category"
                                                    data-parentgroup="<?= $category_slug ?>"
                                                    data-title="<?= $category_name ?>">All</li>

                                                <?php foreach ($children as $child): ?>
                                                    <li class="list-group-item filter-option"
                                                        data-filter="category-<?= $child->id ?>"
                                                        data-parentgroup="<?= $category_slug ?>"
                                                        data-group="<?= $child->slug ?>"
                                                        data-title="<?= Html::encode($child->name) ?>">
                                                        <?= Html::encode($child->name) ?>
                                                    </li>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <!-- Level 2: Products -->
                                                <li class="list-group-item d-none"
                                                    data-filter="all"
                                                    data-group="<?= $category_slug ?>"
                                                    data-title="<?= $category_name ?>">All</li>

                                                <?php foreach ($category->products as $product): ?>
                                                    <?php $product_name = Html::encode($product->name) ?>
                                                    <li class="list-group-item"
                                                        data-filter="<?= 'product-' . $product->id ?>"
                                                        data-group="<?= $category_slug ?>"
                                                        data-title="<?= $product_name ?>">
                                                        <a href="<?= Yii::$app->urlManager->createUrl(['product/detail', 'category_slug' => $product->category->slug, 'product_slug' => $product->slug]) ?>">

                                                            <?= mb_strimwidth(Html::encode($product_name), 0, 200, '...'); ?>
                                                        </a>

                                                    </li>
                                                <?php endforeach; ?>
                                                <?php if (empty($category->products)): ?>
                                                    <li class="list-group-item text-muted">
                                                        No products available
                                                    </li>
                                                <?php endif; ?>
                                            <?php endif; ?>

                                        </ul>
                                    </div>
                                </div>
                            </div>


                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-9 order-lg-2 order-2 col-sm-12 col-xs-12 smt-30">

                <div class="tab-contet shop__grid__view__wrap">
                    <div id="product-header" class="mb-4">
                        <h2></h2>
                    </div>
                    <!-- Start Single View -->
                    <div role="tabpanel" id="grid-view" class="row single-grid-view tab-pane  active clearfix">

                        <?php foreach ($categories as $i => $category): ?>

                            <?php if ($category->children): ?>
                                <?php foreach ($category->children as $child): ?>
                                    <!-- Level 2: Subcategories -->
                                    <div class="col-md-4 col-lg-4 col-sm-12 subcat-item mb-5 d-none" data-filter="<?= 'category-' . $child->id ?>" data-group="<?= $child->slug ?>" data-parentgroup="<?= $category->slug ?>">
                                        <div class="product">
                                            <div class="product__inner">
                                                <div class="pro__thumb">
                                                    <a href="<?= Yii::$app->urlManager->createUrl(['product/index', 'category_slug' => $child->slug]) ?>">
                                                        <img src="<?= $child->getImageUrl() ?>" alt="<?= $child->slug ?>">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="product__details text-center">
                                                <h2><a href="<?= Yii::$app->urlManager->createUrl(['product/index', 'category_slug' => $child->slug]) ?>"><?= $child->name; ?></a></h2>
                                            </div>
                                        </div>
                                    </div>

                                    <?php foreach ($child->products as $product): ?>
                                        <!-- Start Single Product -->
                                        <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12 product-item mb-5 d-none" data-filter="<?= 'product-' . $product->id ?>" data-group="<?= $child->slug ?>" data-parentgroup="<?= $child->parent ? $child->parent->slug : "" ?>">
                                            <div class="product">
                                                <div class="product__inner">
                                                    <div class="pro__thumb">
                                                        <a href="<?= Yii::$app->urlManager->createUrl(['product/detail', 'category_slug' => $product->category->slug, 'product_slug' => $product->slug]) ?>">
                                                            <img src="<?= $product->getImageUrl() ?>" alt="<?= $product->slug ?>">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="product__details text-center">
                                                    <h2><a href="<?= Yii::$app->urlManager->createUrl(['product/detail', 'category_slug' => $product->category->slug, 'product_slug' => $product->slug]) ?>"><?= $product->name; ?></a></h2>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Single Product -->
                                    <?php endforeach; ?>


                                <?php endforeach; ?>
                            <?php endif; ?>

                            <?php foreach ($category->products as $product): ?>
                                <!-- Start Single Product -->
                                <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12 product-item mb-5 d-none" data-filter="<?= 'product-' . $product->id ?>" data-group="<?= $category->slug ?>" data-parentgroup="<?= $category->parent ? $category->parent->slug : "" ?>">
                                    <div class="product">
                                        <div class="product__inner">
                                            <div class="pro__thumb">
                                                <a href="<?= Yii::$app->urlManager->createUrl(['product/detail', 'category_slug' => $product->category->slug, 'product_slug' => $product->slug]) ?>">
                                                    <img src="<?= $product->getImageUrl() ?>" alt="<?= $product->slug ?>">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="product__details text-center">
                                            <h2><a href="<?= Yii::$app->urlManager->createUrl(['product/detail', 'category_slug' => $product->category->slug, 'product_slug' => $product->slug]) ?>"><?= $product->name; ?></a></h2>
                                            <div class="d-flex justify-content-center gap-2 mt-3">
                                                <a href="<?= Yii::$app->urlManager->createUrl(['product/detail', 'category_slug' => $product->category->slug, 'product_slug' => $product->slug]) ?>" class="btn btn-outline-danger px-4">Pelajari Lebih Lanjut</a>
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