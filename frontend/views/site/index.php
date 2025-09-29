<?php

use yii\helpers\Html;
?>

<!-- youtube video  -->


<div class="container-fluid">
    <!-- Start video Area -->
    <div class="row uniq__banner__area">
        <!-- Start video -->
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <div class="banner style--2">
                <div class="video-container">

                    <iframe class="video-background"
                        src="https://www.youtube.com/embed/1nRBH_SHu8o?autoplay=1&mute=1&controls=0&loop=1&playlist=1nRBH_SHu8o&modestbranding=1&showinfo=0"
                        frameborder="0"
                        allow="autoplay; encrypted-media"
                        allowfullscreen>
                    </iframe>
                </div>

            </div>
        </div>

    </div>
    <!-- End Banner Area -->
</div>

<!-- showcase  -->
<div class="container-fluid pt--10">
    <!-- Start Banner Area -->
    <div class="row uniq__banner__area">
        <!-- Start Single Banner -->
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 ">
            <?php $banner = Yii::$app->banner->getByPage('homecat1'); ?>
            <?php if ($banner): ?>
                <div class="banner style--2">
                    <div class="thumb">
                        <a href="#"><img src="<?= $banner->getImageUrl() ?>" alt="<?= $banner->title ?>"></a>
                    </div>
                    <div class="content">
                        <h6 class="text-uppercase"><?= $banner->title ?></h6>
                        <a class="htc__btn shop__now__btn btn btn-outline-light" href="<?= $banner->link ?>">Pelajari Selengkapnya</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <!-- Start Single Banner -->
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 smt-40 xmt-40">
            <?php $banner = Yii::$app->banner->getByPage('homecat2'); ?>
            <?php if ($banner): ?>
                <div class="banner style--2">
                    <div class="thumb">
                        <a href="#"><img src="<?= $banner->getImageUrl() ?>" alt="<?= $banner->title ?>"></a>
                    </div>
                    <div class="content">
                        <h6 class="text-uppercase"><?= $banner->title ?></h6>
                        <a class="htc__btn shop__now__btn btn btn-outline-light" href="<?= $banner->link ?>">Pelajari Selengkapnya</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div class="clearfix"></div>

        <!-- Start Single Banner -->
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 smt-40 xmt-40 pt--20">
            <?php $banner = Yii::$app->banner->getByPage('homecat3'); ?>
            <?php if ($banner): ?>
                <div class="banner style--2">
                    <div class="thumb">
                        <a href="#"><img src="<?= $banner->getImageUrl() ?>" alt="<?= $banner->title ?>"></a>
                    </div>
                    <div class="content">
                        <h6 class="text-uppercase"><?= $banner->title ?></h6>
                        <a class="htc__btn shop__now__btn btn btn-outline-light" href="<?= $banner->link ?>">Pelajari Selengkapnya</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Start Single Banner -->
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 smt-40 xmt-40 pt--20">
            <?php $banner = Yii::$app->banner->getByPage('homecat4'); ?>
            <?php if ($banner): ?>
                <div class="banner style--2">
                    <div class="thumb">
                        <a href="#"><img src="<?= $banner->getImageUrl() ?>" alt="<?= $banner->title ?>"></a>
                    </div>
                    <div class="content">
                        <h6 class="text-uppercase"><?= $banner->title ?></h6>
                        <a class="htc__btn shop__now__btn btn btn-outline-light" href="<?= $banner->link ?>">Pelajari Selengkapnya</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div class="clearfix"></div>


    </div>

    <!-- End Banner Area -->
</div>


