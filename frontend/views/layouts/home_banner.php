<div class="slider__container slider--four slider__new">
    <div class="slider__activation__02 slider__activation__wrap owl-carousel owl-theme">
        <?php $banners = Yii::$app->banner->getHomeBanners(); ?>
        <?php foreach ($banners as $index => $banner): ?>
            <!-- Start Single Slide -->

            <div class="animation__style01 slide slider__fixed--height" style="background: rgba(0, 0, 0, 0) url('<?= $banner->getImageUrl() ?>') no-repeat scroll center center / contain ;">
            </div>
        <?php endforeach; ?>
        <!-- End Single Slide -->
    </div>
</div>