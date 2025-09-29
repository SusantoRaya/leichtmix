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
                        src="https://www.youtube.com/embed/3FeKq1qsVo4?autoplay=1&mute=1&controls=0&loop=1&playlist=3FeKq1qsVo4&modestbranding=1&showinfo=0"
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

        <!-- Start Single Banner -->
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 smt-40 xmt-40 pt--20">
            <?php $banner = Yii::$app->banner->getByPage('homecat5'); ?>
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
            <?php $banner = Yii::$app->banner->getByPage('homecat6'); ?>
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
    </div>

    <!-- End Banner Area -->
</div>

<!-- informasi toko -->
<div class="container-fluid ptb--50">

    <div class="row">
        <div class="col-lg-12">
            <h2 class="text-center">TOKO RESMI BROCO <span class="text-danger">SEKARANG TERSEDIA DI</span></h2>
        </div>
    </div>
    <ul class="social__icon ptb--20">
        <?php foreach ($shops as $shop): ?>
            <li>
                <a href="<?= Html::encode($shop->url) ?>" target="_blank">
                    <?php if ($shop->button_image): ?>
                        <img src="<?= $shop->getButtonImageUrl() ?>"
                            alt="<?= Html::encode($shop->name) ?>"
                            class="img-responsive">
                    <?php else: ?>
                        <div class="btn btn-outline-primary w-100"><?= Html::encode($shop->name) ?></div>
                    <?php endif; ?>
                </a>
            </li>
        <?php endforeach; ?>
       
    </ul>

</div>