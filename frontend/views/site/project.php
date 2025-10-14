<?php
// ✅ Register CSS
$this->registerCss("
    .card img {
        transition: box-shadow 0.3s ease;
         height: 250px;         /* set your preferred height */
        width: 100%;
        object-fit: cover;     /* crop to fit without distortion */
        border-radius: 8px;    /* optional rounded corners */
    overflow: hidden;

    }
    .card:hover img {
        box-shadow: 0 6px 18px rgba(0,0,0,0.15);
    }
    .card p {
        font-size: 1.1rem;
    }

");

// ✅ Register JS + CSS for GLightbox
$this->registerCssFile('https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css', [
    'depends' => [\yii\bootstrap5\BootstrapAsset::class],
]);

$this->registerJsFile('https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js', [
    'depends' => [\yii\web\JqueryAsset::class],
]);

$this->registerJs("
    const lightbox = GLightbox({
        touchNavigation: true,
        loop: true
    });
");
?>

<!-- Start Our Store Area -->

<!-- Section: Referensi Proyek -->
<section class="py-5 bg-white">
    <div class="container text-center">
        <h1 class="title__line">REFERENSI PROYEK</h1>
        <hr class="mb-5" style="width: 90%; max-width: 1200px; border-top: 1px solid #000;">

        <div class="row g-4 justify-content-center">
            <!-- Project 1 -->
            <?php if ($projects): ?>
                <?php foreach ($projects as $project): ?>
                    <div class="col-md-6 col-lg-3">
                        <a href="<?= $project->getFileUrl() ?>" class="glightbox" data-gallery="projects">
                            <div class="card border-0 shadow-sm">
                                <img src="<?= $project->getFileUrl() ?>" class="card-img-top" alt="<?= $project->title ?>">
                                <div class="card-img-overlay d-flex align-items-end justify-content-center p-0">
                                    <div class="w-100  py-2" style="background: rgba(0,0,0,0.6);">
                                        <h2 class="fw-semibold mb-0 text-white"><?= $project->title ?></h2>
                                        <p class="text-white"><?= $project->subtitle ?></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                <?php endforeach; ?>
            <?php endif; ?>


        </div>
    </div>
</section>