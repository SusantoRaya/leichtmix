<div class="slider__container slider--four slider__new">
    <div class="slider__activation__02 slider__activation__wrap owl-carousel owl-theme">
        <?php $banners = Yii::$app->banner->getHomeBanners(); ?>
        <?php foreach ($banners as $index => $banner): ?>
            <!-- Start Single Slide -->

            <!-- <div class="animation__style01 slide slider__fixed--height" style="background: rgba(0, 0, 0, 0) url('') no-repeat scroll center center / contain ;">
            </div> -->

            <picture>
                <source media="(max-width: 576px)" srcset="<?= $banner->getImageUrl_m() ?>">
                <source media="(max-width: 992px)" srcset="<?= $banner->getImageUrl_t() ?>">
                <img src="<?= $banner->getImageUrl() ?>" class="d-block w-100" />
            </picture>
        <?php endforeach; ?>
        <!-- End Single Slide -->
    </div>
</div>