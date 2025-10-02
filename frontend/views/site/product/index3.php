<?php

use yii\helpers\Html;

$this->registerJs(
    <<<'JS'

document.addEventListener('click', function(e) {
  var a = e.target.closest('a[data-bs-toggle="tab"]');
  if (!a) return;
  e.preventDefault();

  var targetSelector = a.getAttribute('href') || a.dataset.bsTarget;
  if (!targetSelector) return;

  // hide all panes
  document.querySelectorAll('.tab-content .tab-pane').forEach(function(p){
    p.classList.remove('show','active');
  });

  // reset all nav-links active state
  document.querySelectorAll('a[data-bs-toggle="tab"]').forEach(function(l){
    l.classList.remove('active');
  });

  // show only the clicked target
  var target = document.querySelector(targetSelector);
  if (target) {
    target.classList.add('show','active');
  }
  a.classList.add('active');
});


// =======

    // $( document ).ready(function() {
    //     const headerEl = document.querySelector("#product-header h2");
    //     const items = document.querySelectorAll(".list-group-item");
    //     const products = document.querySelectorAll(".product-item");
    
    //     items.forEach(item => {
    //         item.addEventListener("click", function () {
    //             // Reset active
    //             items.forEach(li => li.classList.remove("active"));
    //             this.classList.add("active");

    //             const filterValue = this.dataset.filter;
    //             const groupValue = this.dataset.group;
    //             const parentgroupValue = this.dataset.parentgroup;
    //             const products = document.querySelectorAll(".product-item");

    //             products.forEach(p => {
    //                 if (filterValue === "all") {
    //                     // Show only products in the same group
    //                     p.style.display = (p.dataset.group === groupValue) ? "block" : "none";
    //                 } else  if (filterValue === "all-category") {

    //                     // Show only products in the same group
    //                     if(parentgroupValue !== null)
    //                         p.style.display = (p.dataset.parentgroup === parentgroupValue) ? "block" : "none";

    //                 }else if (filterValue.startsWith("category-")) {
    //                     // ✅ Show all products that belong to this child category
    //                     p.style.display = (p.dataset.group === groupValue) ? "block" : "none";
    //                 }
    //                 else {
    //                     // Show only matching filter
    //                     p.style.display = (p.dataset.filter === filterValue) ? "block" : "none";
    //                 }
    //             });

    //             // Update header if "all"
    //             if (this.dataset.title) {
    //                 headerEl.textContent = this.dataset.title;
    //             }
            
    //         });
    //     });


    //     // ✅ Deep link handling
    //     // const urlParams = new URLSearchParams(window.location.search);
    //     // const categoryParam = urlParams.get("category"); // e.g. control-panel OR product-5

    //     const pathParts = window.location.pathname.split("/").filter(Boolean);
    //     // example: /product/control-panel → ["product","control-panel"]
    //     const categoryParam = pathParts.length > 1 ? pathParts[pathParts.length - 1] : null;

    //     if (categoryParam) {
    //         // First try product filter
    //         // let target = document.querySelector(`.list-group-item[data-group='${categoryParam}']`);
    //         // alert(target);
            
    //         // if (!target) {
    //             // If not product, try group "All" under category
    //             let target = document.querySelector(`.list-group-item[data-filter='all'][data-group='${categoryParam}']`);
    //             // alert(target);
    //             let target2 = document.querySelector(`.list-group-item[data-filter='all-category'][data-parentgroup='${categoryParam}']`);
    //         // }

    //         if (target) {
    //             // Open accordion
    //             const collapseEl = target.closest(".accordion-collapse");
    //             if (collapseEl && !collapseEl.classList.contains("show")) {
    //                 const bsCollapse = new bootstrap.Collapse(collapseEl, { toggle: true });
    //             }
    //             // Trigger click to apply filter
    //             target.click();
    //         }

    //         if (target2) {
    //             // Open accordion
    //             const collapseEl = target2.closest(".accordion-collapse");
    //             if (collapseEl && !collapseEl.classList.contains("show")) {
    //                 const bsCollapse = new bootstrap.Collapse(collapseEl, { toggle: true });
    //             }
    //             // Trigger click to apply filter
    //             target2.click();
    //         }

            
    //     } else {
    //         // Default: auto open first "All"
    //         const firstAll = document.querySelector(".list-group-item[data-filter='all']");
    //         if (firstAll) {
    //             firstAll.click();
    //         }
    //     }


    // });
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
                    <div class="accordion" id="categoryAccordion">
                        <?php foreach ($categories as $parentIndex => $category): ?>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading-<?= $parentIndex ?>">

                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapse-<?= $parentIndex ?>"
                                        aria-expanded="false">
                                        <?= Html::encode($category->name) ?>
                                    </button>
                                </h2>

                                <div id="collapse-<?= $parentIndex ?>"
                                    class="accordion-collapse collapse"
                                    data-bs-parent="#categoryAccordion">
                                    <div class="accordion-body">

                                        <?php if ($category->children): ?>
                                            <!-- Level 2: Subcategories -->
                                            <ul class="list-group">
                                                <li class="list-group-item">
                                                    All
                                                </li>

                                                <?php foreach ($category->children as $child): ?>
                                                    <li class="list-group-item">
                                                        <a class="nav-link"
                                                            href="#ctab-<?= $child->id ?>"
                                                            data-bs-toggle="tab">
                                                            <?= Html::encode($child->name) ?>
                                                        </a>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>

                                        <?php else: ?>
                                            <!-- Level 2: Products -->
                                            <ul class="list-group">
                                                <li class="list-group-item">
                                                    <a class="nav-link active" data-bs-toggle="tab" href="#ptab-all">All</a>
                                                </li>
                                                <?php foreach ($category->products as $product): ?>

                                                    <li class="list-group-item">
                                                        <a class="nav-link"
                                                            href="#ptab-<?= $product->id ?>"
                                                            data-bs-toggle="tab">
                                                            <?= Html::encode($product->name) ?>
                                                        </a>
                                                    </li>
                                                <?php endforeach; ?>

                                                <?php if (empty($category->products)): ?>
                                                    <li class="list-group-item text-muted">
                                                        No products available
                                                    </li>
                                                <?php endif; ?>
                                            </ul>
                                        <?php endif; ?>

                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                </div>
            </div>
            <div class="col-md-12 col-lg-9 order-lg-2 order-1 col-sm-12 col-xs-12 smt-30">

                <div class="tab-content shop__grid__view__wrap">
                    <div id="product-header" class="mb-4">
                        <h2></h2>
                    </div>
                    <!-- Start Single View -->
                    <?php foreach ($categories as $i => $category): ?>

                        <?php if ($category->children): ?>

                            <!-- Subcategory tabs -->
                            <?php foreach ($category->children as $child): ?>
                                <div class="tab-pane fade" id="ctab-<?= $child->id ?>">
                                    <h3><?= Html::encode($child->name) ?></h3>
                                    <p>This is where you could load child category products or description.</p>
                                </div>
                            <?php endforeach; ?>

                        <?php else: ?>

                            <?php foreach ($category->products as $product): ?>

                                <div class="tab-pane fade" id="ptab-<?= $product->id ?>">
                                    <!-- Product tabs -->
                                    <div class="col-md-4 col-lg-4 col-sm-12 product-item mb-5">
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
                                    <!-- Products tabs -->
                                </div>

                            <?php endforeach; ?>

                        <?php endif; ?>

                    <?php endforeach; ?>
                    <!-- End Single View -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Our ShopSide Area -->