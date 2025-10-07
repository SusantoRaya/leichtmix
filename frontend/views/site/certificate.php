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
                    <h1 class="title__line">SERTIFIKASI</h1>
                </div>
            </div>

            <hr class="mt-3" style="border: 1px solid #000;">
        </div>


        <div class="py-5" style="background: rgba(0, 0, 0, 0) url(<?= Yii::getAlias('@web') ?>/images/bg/hubungi-kami.png) no-repeat scroll center center / contain ; height:auto; padding: 80px 0;">
            <?php if ($certificate_national): ?>
                <h2 class="text-center fw-bold mb-5">Sertifikasi Nasional</h2>
                <div class="row justify-content-center">

                    <?php foreach ($certificate_national as $cert): ?>
                       <div class="col-md-4 mb-4">
                            <img src="<?= $cert->getFileUrl() ?>" class="img-fluid" />
                        </div>

                    <?php endforeach; ?>
                </div>
            <?php endif; ?>


            <?php if ($certificate_international): ?>
                <h2 class="text-center fw-bold mb-5">Sertifikasi Internasional</h2>
                <div class="row justify-content-center">

                    <?php foreach ($certificate_international as $cert): ?>
                        <div class="col-md-4 mb-4">
                            <img src="<?= $cert->getFileUrl() ?>" class="img-fluid" />
                        </div>

                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>


</section>
<!-- End Our Store Area -->