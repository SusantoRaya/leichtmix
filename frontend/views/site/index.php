<?php

use yii\helpers\Html;

$this->title = 'Leichtmix Premium Mortar - Bersama Membangun Tanah Air';
?>

<!-- youtube video  -->


<!-- <div class="container-fluid"> -->
<!-- Start video Area -->
<div class="row uniq__banner__area">
    <!-- Start video -->
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12  pb--10">
        <div class="banner style--2">
            <div class="video-container">

                <iframe class="video-background"
                    src="https://www.youtube.com/embed/1nRBH_SHu8o?autoplay=1&controls=1&loop=1&playlist=1nRBH_SHu8o"
                    frameborder="0"
                    allow="autoplay; encrypted-media"
                    allowfullscreen>
                </iframe>
            </div>

        </div>
    </div>

</div>
<!-- End Banner Area -->
<!-- </div> -->

<!-- showcase  -->
<!-- <div class="container-fluid pt--10"> -->
<!-- Start Banner Area -->
<div class="row uniq__banner__area">
    <!-- Start Single Banner -->
    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 pb--10">
        <?php $banner = Yii::$app->banner->getByPage('homecat1'); ?>
        <?php if ($banner): ?>
            <div class="banner style--2">
                <div class="thumb">
                    <a href="#"><img src="<?= $banner->getImageUrl() ?>" alt="<?= $banner->title ?>"></a>
                </div>
                <div class="content">
                    <span class="d-block d-flex flex-rows align-items-center justify-content-between w-100 text-white px-3 px-lg-4 homecat">
                        <span>
                            <h6 class="m-0 text-white"><?= $banner->title ?></h6>
                        </span>
                        <span>
                            <a href="<?= $banner->link ?>" class="btn btn-succes rounded-pill text-white border-3 border-white align-items-center px-3"><i class="fas fa-circle fs-sm mr-3">
                                </i><span class="fs-small ms-2">Pelajari Lebih Lanjut</span>
                            </a>
                        </span>
                    </span>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <!-- Start Single Banner -->
    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 pb--10">
        <?php $banner = Yii::$app->banner->getByPage('homecat2'); ?>
        <?php if ($banner): ?>
            <div class="banner style--2">
                <div class="thumb">
                    <a href="#"><img src="<?= $banner->getImageUrl() ?>" alt="<?= $banner->title ?>"></a>
                </div>
                <div class="content">
                    <span class="d-block d-flex flex-rows align-items-center justify-content-between w-100 text-white px-3 px-lg-4 homecat">
                        <span>
                            <h6 class="m-0 text-white"><?= $banner->title ?></h6>
                        </span>
                        <span>
                            <a href="<?= $banner->link ?>" class="btn btn-succes rounded-pill text-white border-3 border-white align-items-center px-3"><i class="fas fa-circle fs-sm mr-3">
                                </i><span class="fs-small ms-2">Pelajari Lebih Lanjut</span>
                            </a>
                        </span>
                    </span>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <div class="clearfix"></div>

    <!-- Start Single Banner -->
    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 pb--10">
        <?php $banner = Yii::$app->banner->getByPage('homecat3'); ?>
        <?php if ($banner): ?>
            <div class="banner style--2">
                <div class="thumb">
                    <a href="#"><img src="<?= $banner->getImageUrl() ?>" alt="<?= $banner->title ?>"></a>
                </div>
                <div class="content">
                    <span class="d-block d-flex flex-rows align-items-center justify-content-between w-100 text-white px-3 px-lg-4 homecat">
                        <span>
                            <h6 class="m-0 text-white"><?= $banner->title ?></h6>
                        </span>
                        <span>
                            <a href="<?= $banner->link ?>" class="btn btn-succes rounded-pill text-white border-3 border-white align-items-center px-3"><i class="fas fa-circle fs-sm mr-3">
                                </i><span class="fs-small ms-2">Pelajari Lebih Lanjut</span>
                            </a>
                        </span>
                    </span>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Start Single Banner -->
    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 pb--10">
        <?php $banner = Yii::$app->banner->getByPage('homecat4'); ?>
        <?php if ($banner): ?>
            <div class="banner style--2">
                <div class="thumb">
                    <a href="#"><img src="<?= $banner->getImageUrl() ?>" alt="<?= $banner->title ?>"></a>
                </div>
                <div class="content">
                    <span class="d-block d-flex flex-rows align-items-center justify-content-between w-100 text-white px-3 px-lg-4 homecat">
                        <span>
                            <h6 class="m-0 text-white"><?= $banner->title ?></h6>
                        </span>
                        <span>
                            <a href="<?= $banner->link ?>" class="btn btn-succes rounded-pill text-white border-3 border-white align-items-center px-3"><i class="fas fa-circle fs-sm mr-3">
                                </i><span class="fs-small ms-2">Pelajari Lebih Lanjut</span>
                            </a>
                        </span>
                    </span>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <div class="clearfix"></div>


</div>

<!-- End Banner Area -->
<!-- </div> -->