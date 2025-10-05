 <!-- Start Bradcaump area -->
 <?php $banner = Yii::$app->banner->getByPage('download_apps'); ?>
 <?php if ($banner): ?>
     <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(<?= $banner->getImageUrl() ?>) no-repeat scroll center center / cover ;">
         <div class="ht__bradcaump__wrap">
             <div class="container">

             </div>
         </div>
     </div>
 <?php endif; ?>
 <!-- End Bradcaump area -->


 <!-- Start Our Store Area -->
 <section class="htc__store__area pt--120 bg__white">
     <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <div class="section__title section__title--2 text-center">
                     <h1 class="title__line">Download Apps</h1>
                     <p>Gunakan BroConnect untuk mengontrol dan mengelola produk Broco Smart</p>
                 </div>
             </div>
         </div>

         <hr style="border: 1px solid #000;">
         <div class="">
             <div class="row">
                 <div class="col-md-12 col-xs-12 col-lg-6 border-end">
                     <img src="<?= Yii::getAlias('@web') ?>/images/bg/app.jpg" alt="">
                 </div>

                 <div class="col-md-12 col-xs-12 col-lg-6 d-flex flex-column justify-content-center align-items-center store-logos my-2">

                     <a href="https://apps.apple.com/us/app/broconnect/id6743197111" target="_blank">
                         <img src="<?= Yii::getAlias('@web') ?>/images/bg/app-store.png"
                             alt="App Store"
                             class="my-2"
                             style="width: 160px; height: auto; object-fit: contain;">
                     </a>
                     <a href="https://play.google.com/store/apps/details?id=com.broco.smart.home&hl=en" target="_blank">
                         <img src="<?= Yii::getAlias('@web') ?>/images/bg/play-store.png"
                             alt="Play Store"
                             class="my-2"
                             style="width: 160px; height: auto; object-fit: contain;">
                     </a>
                 </div>
             </div>
         </div>


     </div>
 </section>
 <!-- End Our Store Area -->