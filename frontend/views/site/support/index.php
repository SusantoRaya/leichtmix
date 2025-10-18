<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Support - Leichtmix Premium Mortar - Bersama Membangun Tanah Air';
$this->registerMetaTag(['name' => 'description', 'content' => '']);

$this->registerJs(
    <<<'JS'

    // default type from URL or fallback to faq
    let currentType = new URLSearchParams(window.location.search).get('type') || 'faq';

    function updateBlockInformation(){

        $('.tab-content .faq-block, .tab-content .guide-block, .tab-content .video-block').hide();
        $('#banner-faq , #banner-guide ,#banner-video').hide();

        if(currentType === 'faq'){
            $('.tab-content .faq-block').show();
            $('#banner-faq').removeClass('d-none').show();
        }
        else if(currentType === 'guide'){
            $('.tab-content .guide-block').show();
            $('#banner-guide').removeClass('d-none').show();
        }
        else if(currentType === 'video'){
            $('.tab-content .video-block').show();
            $('#banner-video').removeClass('d-none').show();
        }else{
            $('#banner-faq').removeClass('d-none').show();
        }

    }
    // Run when page fully loads
    $(window).on('load', function() {
        // hide all first
        $('.tab-content .faq-block, .tab-content .guide-block, .tab-content .video-block').hide();
        $('#banner-faq , #banner-guide ,#banner-video').hide();
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


    document.querySelectorAll(".custom-btn").forEach(btn => {
        btn.addEventListener("click", function (e) {
            e.preventDefault(); // prevent link navigation
           // Reset all buttons
            document.querySelectorAll(".custom-btn").forEach(b => {
            b.classList.remove("active");
            const icon = b.querySelector("i");
            const text = b.querySelector("span");
            if (icon) icon.classList.remove("text-danger");
            if (text) text.classList.remove("text-danger");
            });

            // Activate the clicked button
            this.classList.add("active");
            const icon = this.querySelector("i");
            const text = this.querySelector("span");
            if (icon) icon.classList.add("text-danger");
            if (text) text.classList.add("text-danger");
        });
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

    .custom-btn {
  border-radius: 50px;         /* pill shape */
  background-color: #fff;      /* white background */
  border: 1px solid #ddd;      /* light gray border */
  padding: 8px 16px;           /* spacing */
  display: flex;
  align-items: center;
  box-shadow: none;
}

.custom-btn:hover {
  background-color: #f8f9fa;   /* light gray hover */
  border-color: #ccc;
}

.category-list {
        border: none;
        border-bottom: 1px solid #ddd;   /* divider line between items */
    }

CSS
);


?>


<?php $banner = Yii::$app->banner->getByPage('support_faq');
if ($banner): ?>
    <div class="ht__bradcaump__area d-none" id="<?= 'banner-faq' ?>" style="background: rgba(0, 0, 0, 0) url(<?= $banner->getImageUrl() ?>) no-repeat scroll center center / cover ;">
        <div class="ht__bradcaump__wrap">
            <div class="container">

            </div>
        </div>
    </div>
<?php endif; ?>

<?php $banner = Yii::$app->banner->getByPage('support_video');
if ($banner): ?>
    <div class="ht__bradcaump__area d-none" id="<?= 'banner-video' ?>" style="background: rgba(0, 0, 0, 0) url(<?= $banner->getImageUrl() ?>) no-repeat scroll center center / cover ;">
        <div class="ht__bradcaump__wrap">
            <div class="container">

            </div>
        </div>
    </div>
<?php endif; ?>

<?php $banner = Yii::$app->banner->getByPage('support_guide');
if ($banner): ?>
    <div class="ht__bradcaump__area d-none" id="<?= 'banner-guide' ?>" style="background: rgba(0, 0, 0, 0) url(<?= $banner->getImageUrl() ?>) no-repeat scroll center center / cover ;">
        <div class="ht__bradcaump__wrap">
            <div class="container">

            </div>
        </div>
    </div>
<?php endif; ?>


<!-- End Bradcaump area -->

<div class="container py-5">

    <!-- Tabs -->
    <ul class="nav nav-pills justify-content-center mb-4 tab-buttons" id="pills-tab" role="tablist">
        <li class="nav-item p-3" role="presentation">
            <button class="custom-btn btn btn-lg" id="faq-tab" data-bs-toggle="pill" data-type="faq">
                <i class="fa-regular fa-circle-question me-2"></i>
                <span class="fw-bold">FAQ</span>
            </button>
        </li>
        <li class="nav-item p-3" role="presentation">
            <button class="custom-btn btn btn-lg" id="panduan-tab" data-bs-toggle="pill" data-type="guide">
                <i class="fa-solid fa-book me-2"></i>
                <span class="fw-bold">Panduan Pengguna</span>
            </button>
        </li>
        <li class="nav-item p-3" role="presentation">
            <button class="custom-btn btn btn-lg" id="video-tab" data-bs-toggle="pill" data-type="video">
                <i class="fa-regular fa-circle-play me-2"></i>
                <span class="fw-bold">Video Instalasi</span>
            </button>
        </li>
    </ul>

    <div class="row">

        <!-- Left Category List -->
        <div class="col-md-3 border-end">
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
                            <h2 class="mb-3"><?= Html::encode($category->name) ?></h2>
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