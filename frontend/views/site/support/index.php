<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->registerJs(
    <<<'JS'

    // default type from URL or fallback to faq
    let currentType = new URLSearchParams(window.location.search).get('type') || 'faq';

    function updateBlockInformation(){

        $('.tab-content .faq-block, .tab-content .guide-block, .tab-content .video-block').hide();
        if(currentType === 'faq'){
            $('.tab-content .faq-block').show();
        }
        if(currentType === 'guide'){
            $('.tab-content .guide-block').show();
        }
        if(currentType === 'video'){
            $('.tab-content .video-block').show();
        }

    }
    // Run when page fully loads
    $(window).on('load', function() {
        // hide all first
        $('.tab-content .faq-block, .tab-content .guide-block, .tab-content .video-block').hide();
        // show default/current type
        updateBlockInformation();
    });

    document.querySelectorAll('.tab-buttons button').forEach(btn => {
        btn.addEventListener('click', () => {
            currentType = btn.dataset.type; // set currentType
            const url = new URL(window.location);
            url.searchParams.set('type', currentType);
            window.history.pushState({}, '', url);

            console.log("currentType:", currentType); // now you can use it
            updateBlockInformation();
        });
    });



    document.querySelectorAll(".list-group-item").forEach(item => {
        item.addEventListener("click", function () {
        // Reset active
        document.querySelectorAll(".list-group-item").forEach(li => li.classList.remove("active"));
        this.classList.add("active");

        const filterValue = this.dataset.filter;
            updateBlockInformation();
        });
    });

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

JS
);

$this->registerCss(
    <<<'CSS'

.category-list .list-group-item {
        border: none;
        border-bottom: 1px solid #ddd;
        font-weight: 600;
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        padding: 0.75rem 1rem;
    }

    .category-list .list-group-item .arrow {
        color: red;
        font-size: 14px;
    }

    .category-list .list-group-item.active {
        background: #f8f9fa;
        color: #000;
        font-weight: 700;
    }

    .category-list .list-group-item.active .arrow {
        content: "▼";
        transform: rotate(90deg);
    }

CSS
);


?>

<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(<?= Yii::getAlias('@web') ?>/images/bg/2.jpg) no-repeat scroll center center / cover ;">
    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bradcaump__inner text-center">
                        <h2 class="bradcaump-title">About Us</h2>
                        <nav class="bradcaump-inner">
                            <a class="breadcrumb-item" href="index.html">Home</a>
                            <span class="brd-separetor">/</span>
                            <span class="breadcrumb-item active">About Us</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->

<div class="container py-5">

    <!-- Tabs -->
    <ul class="nav nav-pills justify-content-center mb-4 tab-buttons" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="faq-tab" data-bs-toggle="pill" data-type="faq">
                FAQ
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="panduan-tab" data-bs-toggle="pill" data-type="guide">
                User Guide
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="video-tab" data-bs-toggle="pill" data-type="video">
                Video Instalasi
            </button>
        </li>
    </ul>

    <div class="row">


        <!-- <div class="tab-buttons">
            <button data-type="faq">FAQ</button>
            <button data-type="guide">Guide</button>
            <button data-type="video">Video</button>
        </div> -->


        <!-- Left Category List -->
        <div class="col-md-3">
            <div class="list-group category-list" id="category-tab" role="tablist">
                <?php foreach ($categories as $i => $category): ?>

                    <?php
                    $category_name = Html::encode($category->name);
                    $category_slug = $category->slug;

                    ?>
                    <a class="list-group-item <?= $i === 0 ? 'active' : '' ?> " data-bs-toggle="list" data-filter="<?= 'cat-' . $category->id ?>" href="<?= '#cat-' . $category->id ?>" role="tab">
                        <?= $category_name ?> <span class="arrow">▶</span>
                    </a>
                <?php endforeach; ?>


            </div>
        </div>

        <!-- Right Tab Content -->
        <div class="col-md-9">
            <div class="tab-content">

                <?php foreach ($categories as $i => $category): ?>

                    <div class="tab-pane fade <?= $i === 0 ? 'show active' : '' ?>" id="<?= 'cat-' . $category->id ?>" role="tabpanel">
                        <h4><?= Html::encode($category->name) ?></h4>
                        <div class="faq-block">
                            <?= $this->render('_faq2', ['faqs' => $category->faqs]) ?>
                        </div>

                        <div class="guide-block row">
                            <?= $this->render('_guide', ['category' => $category]) ?>
                        </div>

                        <div class="video-block row">
                            <?= $this->render('_video', ['category' => $category]) ?>
                        </div>

                    </div>

                <?php endforeach; ?>


            </div>
        </div>
    </div>
</div>



<!-- Modal -->
<!-- One modal only -->
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