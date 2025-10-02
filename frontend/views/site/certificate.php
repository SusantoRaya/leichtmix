<?php

use yii\helpers\Html; ?>
<?php $banner = Yii::$app->banner->getByPage('certificate'); ?>
<?php if ($banner): ?>
    <!-- Start Bradcaump area -->
    <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(<?= $banner->getImageUrl() ?>) no-repeat scroll center center / cover ;">
        <div class="ht__bradcaump__wrap">
            <div class="container">

            </div>
        </div>
    </div>
<?php endif; ?>
<!-- End Bradcaump area -->


<!-- Start Our Store Area -->
<section class="htc__store__area ptb--120 bg__white">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section__title section__title--2 text-center">
                    <h1 class="title__line">Sertifikasi</h1>
                </div>
            </div>
        </div>

        <div class=" py-5">
            <h2 class="text-center fw-bold mb-5">Sertifikasi Nasional</h2>
            <div class="row justify-content-center">

                <?php foreach ($certificates as $cert): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm border-0 h-100 text-center">
                            <iframe src="<?= $cert->getFileUrl() ?>" class="w-100" style="height:500px;" frameborder="0"></iframe>
                            <div class="card-body">
                                <a href="<?= $cert->getFileUrl() ?>" target="_blank" class="btn btn-outline-primary">
                                    Download
                                </a>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
            </div>



        </div>
</section>
<!-- End Our Store Area -->